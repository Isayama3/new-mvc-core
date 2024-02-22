<?php

namespace App\Base\Controllers\API;

use Helper\Attachment;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Base\Exports\PublicExport;
use App\Http\Controllers\Controller as LaraveController;
use App\Base\Traits\Model\FilterSort;
use App\Base\Resources\SimpleResource;
use Illuminate\Database\Eloquent\Model;
use App\Base\Traits\Request\SendRequest;
use Illuminate\Support\Facades\Validator;
use App\Base\Traits\Response\SendResponse;
use Illuminate\Foundation\Http\FormRequest;
use App\Base\Services\SingletonAuthPermissions;
use App\Base\Traits\Custom\AttachmentAttribute;

class Controller extends LaraveController
{
    use SendResponse;
    use SendRequest;

    /**
     * the request
     *
     * @var FormRequest
     */
    protected $request;

    /**
     * the eloquent model
     *
     * @var Model
     */
    protected $model;

    /**
     * the eloquent API resource
     *
     * @var string
     */
    protected $resource;
    protected $queryItem;
    protected $hasDelete;
    protected $media;
    protected $cache;
    protected $cache_time;
    protected $permissions;


    /**
     * Init.
     *
     * @codeCoverageIgnore
     * @param FormRequest $request
     * @param Model       $model
     * @param string      $resource
     * @return void
     */

    public function __construct(
        FormRequest $request,
        Model $model,
        $resource,
        $queryItem = [],
        $hasDelete = false,
        $media = false,
        $cache = true,
        $cache_time = 60 * 1,
        $permissions = false
    ) {
        $this->request = $request;
        $this->model = $model;
        $this->resource = $resource;
        $this->queryItem = $queryItem;
        $this->hasDelete = $hasDelete;
        $this->media = $media;
        $this->cache = $cache;
        $this->cache_time = $cache_time;
        $this->permissions = $permissions;
    }


    public function can($route)
    {
        $action = 'api.v1.admin.' . $route;
        $singleton_obj = SingletonAuthPermissions::getInstance();
        if (stripos($singleton_obj->getAllPermissions(), $action) !== false) {
            if (stripos($singleton_obj->getAuthPermissions(), $action) == false) {
                return false;
            }
        }
        return true;
    }

    public function relations(): array
    {
        return [];
    }

    public function indexColumns(): array
    {
        return [];
    }

    public function processIndexColumns(): array
    {
        $index_columns = $this->indexColumns() + [
            'created_at' => [],
            'updated_at' => [],
        ];
        foreach ($index_columns as $column => $value) {
            if ($column == 'id') {
                $index_columns[$column]['grid_view']    = false;
                $index_columns[$column]['visible']      = false;
            } else {
                $index_columns[$column]['grid_view']    = $index_columns[$column]['grid_view'] ?? true;
                $index_columns[$column]['visible']      = $index_columns[$column]['visible'] ??  true;
            }
            $index_columns[$column]['validation']   = $index_columns[$column]['validation'] ?? 'required';
            $index_columns[$column]['type']         = $index_columns[$column]['type'] ?? 'string';
        }

        return $index_columns;
    }

    public function indexActions(): array
    {
        return [];
    }

    public function processIndexActions()
    {
        $index_actions = $this->indexActions();
        $index_actions['detail'] = $index_actions['detail'] ?? true;
        $index_actions['remove'] = $index_actions['remove'] ?? true;
        $index_actions['update'] = $index_actions['update'] ?? true;
        $index_actions['create'] = $index_actions['create'] ?? true;

        return $index_actions;
    }


    public function filter()
    {
        $filters  = [];
        foreach ($this->model->filterColumns() as $key => $value) {
            if (is_object($value)) {
                $filters[] = $value->getName();
            } else {
                $filters[] = $value;
            }
        }
        return $filters;
    }

    public function bearerToken()
    {
        $header = request()->header('Authorization', '');
        if (Str::startsWith($header, 'Bearer ')) {
            return Str::substr($header, 7);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $record = $this->model;
        if (in_array(FilterSort::class, class_uses_recursive($this->model))) {
            $record = $record->setFilters()->defaultSort('-created_at');
        } else {
            $record = $this->model->where($this->queryItem)->latest();
        }

        if (!empty($this->relations())) {
            $record = $record->with(...$this->relations());
        }

        if ($this->cache) {
            $record = $record->remember($this->cache_time)->cacheTags($this->model->getTableName());
        }

        $record = $record->paginate($this->request->per_page ?? 10);
        return $this->sendResponse(
            $this->resource::collection($record),
            withmeta: true,
            permissions: $this->permissions,
            columns: $this->processIndexColumns(),
            actions: $this->processIndexActions(),
            filter: $this->filter(),
        );
    }



    public function list()
    {
        $record = $this->model->take(3000)->remember($this->cache_time)->cacheTags($this->model->getTableName() . '-list')->get(['id', 'name']);
        return $this->sendResponse(SimpleResource::collection($record));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        if ($this->media) {
            $validator = Validator::make(request()->all(), [
                'media' => 'required|array',
                'media.*' => 'mimes:jpg,png,jpeg,gif,svg,pdf|max:4000',
            ]);

            if ($validator->fails()) {
                return $this->ErrorValidate(
                    $validator->errors()->toArray(),
                );
            }
        }

        if ($this->cache) {
            $this->model->flushCache($this->model->getTableName());
            $this->model->flushCache($this->model->getTableName() . '-list');
        }

        $record = $this->model->create($this->request->validated());

        if (!empty(request()->media)) {
            $options = [
                "usage" => ((new \ReflectionClass($this->model))->getShortName()),
            ];

            foreach (request()->media as $image) {
                if ($image) {
                    Attachment::addAttachment($image, $record, 'upload/' . ((new \ReflectionClass($this->model))->getShortName()), $options);
                }
            }
        }


        if (request()->has('img')) {
            $path = request()->file('img')->store('public');
            $record->img = str_replace('public/', 'storage/', $path);
            $record->save();
        }




        $record->fresh();

        if (!empty($this->relations())) {
            $record = $record->load(...$this->relations());
        }


        $this->model = $record;
        return $this->sendResponse(
            new $this->resource($record),
            'تم الاضافة بنجاح',
            true,
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if (!empty($this->relations())) {
            $record = $this->model->with(...$this->relations())->findOrFail($id);
        } else {
            $record = $this->model->findOrFail($id);
        }

        return $this->sendResponse(new $this->resource($record));
    }

    /**
     * Update a resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $model = $this->model->findOrFail($id);
        $model->update(Arr::except($this->request->validated(), 'img'));


        if (!empty(request()->media)) {
            $options = [
                "usage" => ((new \ReflectionClass($model))->getShortName()),
            ];

            foreach (request()->media as $image) {
                if ($image) {
                    Attachment::addAttachment($image, $model, 'upload/' . ((new \ReflectionClass($model))->getShortName()), $options);
                }
            }
        }

        if (request()->has('img')) {
            @unlink(storage_path(str_replace('storage/', 'app/public/', $model->img)));
            $path = request()->file('img')->store('public');
            $model->img = str_replace('public/', 'storage/', $path);
            $model->save();
        }

        if ($this->cache) {
            $this->model->flushCache($this->model->getTableName());
            $this->model->flushCache($this->model->getTableName() . '-list');
        }



        if (!empty($this->relations())) {
            $model = $model->load(...$this->relations());
        }
        $this->model = $model;


        return $this->sendResponse(new $this->resource($model), 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        if ($this->hasDelete) {
            $model = $this->model->findOrFail($id);

            foreach ($this->model->deleteRelations() as $key) {
                if ($model->$key()->count() > 0)
                    return $this->ErrorMessage(' غير مسموح بالحذف لوجود بيانات مرتبطة');
            }
            if ($model->img) {
                @unlink(storage_path(str_replace('storage/', 'app/public/', $model->img)));
            }

            if (in_array(AttachmentAttribute::class, class_uses_recursive($this->model))) {
                Attachment::deleteAttachment($model, multiple: true);
            }

            $model->delete();
            if ($this->cache) {
                $this->model->flushCache($this->model->getTableName());
                $this->model->flushCache($this->model->getTableName() . '-list');
            }
            return $this->SuccessMessage('تم الحذف بنجاح');
        } else {
            return $this->ErrorMessage('غير مسموح بالحذف');
        }
    }

    public function excelExport()
    {
        $record = $this->model;
        if (in_array(FilterSort::class, class_uses_recursive($this->model))) {
            $record = $record->setFilters()->defaultSort('-created_at');
        } else {
            $record = $this->model->where($this->queryItem)->latest();
        }
        if (!empty($this->relations())) {
            $record = $record->with(...$this->relations());
        }
        $record = $record->take(3000)->remember($this->cache_time)->cacheTags($this->model->getTableName() . '-export')->get();
        $collection =  $this->resource::collection($record);
        return (new PublicExport($collection))->download($this->model->getTableName() . '.xlsx');
    }
}