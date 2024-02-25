<section class="section">
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                    <button class="btn btn-primary m-1" type="button" data-bs-toggle="collapse" data-bs-target="#filter"
                        aria-expanded="true" aria-controls="filter">
                        <i class="bi bi-arrow-down"></i>
                        {{ __('admin_panel.search') }}
                    </button>
                    <a href="{{ route($create_route) }}">
                        <button href class="btn btn-primary m-1 float-end" type="button">
                            <i class="bi bi-plus-lg"></i>
                            {{ __('admin_panel.add_new') }}
                        </button>
                    </a>
                </div>
                <div class="card-content">
                    <div class="collapse" id="filter" style="">
                        <div class="card-body">
                            <form class="form">
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        {{ \App\Base\Helper\Field::text(name: 'filter[name]', label: 'name', required: 'false', placeholder: 'name') }}
                                    </div>
                                    <div class="col-md-3 col-12">
                                        {{ \App\Base\Helper\Field::text(name: 'filter[description]', label: 'description', required: 'false', placeholder: 'description') }}
                                    </div>
                                    <div class="col-md-3 col-12">
                                        {{ \App\Base\Helper\Field::dateTime(name: 'filter[created_at]', label: 'created_at', required: 'false') }}
                                    </div>
                                    <div class="col-md-3 col-12">
                                        {{ \App\Base\Helper\Field::dateTime(name: 'filter[updated_at]', label: 'updated_at', required: 'false') }}
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-success me-1 mb-1">{{ __('admin_panel.submit') }}</button>
                                        <button type="reset"
                                            class="btn btn-danger me-1 mb-1">{{ __('admin_panel.reset') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
