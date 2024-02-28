<form class="form">
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                        <div>
                            <button class="btn btn-primary m-1" type="button" data-bs-toggle="collapse"
                                data-bs-target="#filter" aria-expanded="true" aria-controls="filter">
                                <i class="bi bi-arrow-down"></i>
                                {{ __('admin.search') }}
                            </button>
                            <button class="btn btn-danger m-1" type="submit" data-bs-toggle="collapse">
                                {{ __('admin.reset_search') }}
                            </button>
                        </div>
                        <a href="{{ route($create_route) }}">
                            <button href class="btn btn-primary m-1 float-end" type="button">
                                <i class="bi bi-plus-lg"></i>
                                {{ __('admin.add_new') }}
                            </button>
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="collapse" id="filter" style="">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($filters as $filter)
                                        <div class="col-md-3 col-12">
                                            {{ call_user_func_array([App\Base\Helper\Field::class, $filter['type']], array_pad([$filter['name'], $filter['label']], 5, null)) }}
                                        </div>
                                    @endforeach
                                    <div class="col-md-3 col-12">
                                        {{ \App\Base\Helper\Field::dateTime(name: 'filter[created_at]', label: 'created_at', required: 'false') }}
                                    </div>
                                    <div class="col-md-3 col-12">
                                        {{ \App\Base\Helper\Field::dateTime(name: 'filter[updated_at]', label: 'updated_at', required: 'false') }}
                                    </div>
                                    {{-- @foreach ($filter as $key => $value)
                                        @if ($columns[$key]['input-type'] == 'text')
                                            <div class="col-md-3 col-12">
                                                {{ \App\Base\Helper\Field::text("filter[$key]", $key, required: 'false') }}
                                            </div>
                                        @elseif ($columns[$key]['input-type'] == 'email')
                                            <div class="col-md-3 col-12">
                                                {{ \App\Base\Helper\Field::email("filter[$key]", $key, required: 'false') }}
                                            </div>
                                        @elseif ($columns[$key]['input-type'] == 'number')
                                            <div class="col-md-3 col-12">
                                                {{ \App\Base\Helper\Field::number("filter[$key]", $key, required: 'false') }}
                                            </div>
                                        @elseif ($columns[$key]['input-type'] == 'password')
                                            <div class="col-md-3 col-12">
                                                {{ \App\Base\Helper\Field::password("filter[$key]", $key, required: 'false') }}
                                            </div>
                                        @elseif ($columns[$key]['input-type'] == 'checkBox')
                                            <div class="col-md-3 col-12">
                                                {{ \App\Base\Helper\Field::checkBox("filter[$key]", $key, required: 'false') }}
                                            </div>
                                        @elseif ($columns[$key]['input-type'] == 'radio')
                                            <div class="col-md-3 col-12">
                                                {{ \App\Base\Helper\Field::radio("filter[$key]", $key, required: 'false') }}
                                            </div>
                                        @elseif ($columns[$key]['input-type'] == 'textarea')
                                            <div class="col-md-3 col-12">
                                                {{ \App\Base\Helper\Field::textarea("filter[$key]", $key, required: 'false') }}
                                            </div>
                                        @elseif ($columns[$key]['input-type'] == 'fileWithPreview')
                                            <div class="col-md-3 col-12">
                                                {{ \App\Base\Helper\Field::fileWithPreview("filter[$key]", $key, required: 'false') }}
                                            </div>
                                        @elseif ($columns[$key]['input-type'] == 'multiFileUpload')
                                            <div class="col-md-3 col-12">
                                                {{ \App\Base\Helper\Field::multiFileUpload("filter[$key]", $key, required: 'false') }}
                                            </div>
                                        @elseif ($columns[$key]['input-type'] == 'dateTime')
                                            <div class="col-md-3 col-12">
                                                {{ \App\Base\Helper\Field::dateTime("filter[$key]", $key, required: 'false') }}
                                            </div>
                                        @elseif ($columns[$key]['input-type'] == 'dateRange')
                                            <div class="col-md-3 col-12">
                                                {{ \App\Base\Helper\Field::dateTime("filter[$key]", $key, required: 'false') }}
                                            </div>
                                        @elseif ($columns[$key]['input-type'] == 'select')
                                            <div class="col-md-3 col-12">
                                                {{ \App\Base\Helper\Field::select("filter[$key]", $key, $columns[$key]['options']) }}
                                            </div>
                                        @endif
                                    @endforeach --}}
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-success me-1 mb-1">{{ __('admin.submit') }}</button>
                                        <button type="reset"
                                            class="btn btn-danger me-1 mb-1">{{ __('admin.reset_fields') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</form>
