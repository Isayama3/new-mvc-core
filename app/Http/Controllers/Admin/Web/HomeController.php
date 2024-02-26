<?php

namespace App\Http\Controllers\Admin\Web;

use App\Base\Controllers\Web\Controller;
use App\Models\Admin\Admin as Model;
use Illuminate\Foundation\Http\FormRequest;

class HomeController extends Controller
{
    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
            view_path : 'admin.home.',
        );
    }
}
