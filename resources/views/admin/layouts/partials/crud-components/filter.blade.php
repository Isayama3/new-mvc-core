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
                            <button class="btn btn-danger m-1" type="submit" id="reset-then-submit"
                                data-bs-toggle="collapse">
                                {{ __('admin.reset_search') }}
                            </button>
                        </div>
                        @if ($create_route)
                            <a href="{{ route($create_route) }}">
                                <button href class="btn btn-primary m-1 float-end" type="button">
                                    <i class="bi bi-plus-lg"></i>
                                    {{ __('admin.add_new') }}
                                </button>
                            </a>
                        @endif
                    </div>
                    <div class="card-content">
                        <div class="collapse" id="filter" style="">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($filters as $filter)
                                        <div class="col-md-3 col-12">
                                            {{ call_user_func_array([App\Base\Helper\Field::class, $filter['type']], array_pad([$filter['name'], $filter['label'], isset($filter['options']) ? $filter['options'] : null], 5, null)) }}
                                        </div>
                                    @endforeach
                                    <div class="col-md-3 col-12">
                                        {{ \App\Base\Helper\Field::dateTime(name: 'filter[created_at]', label: 'created_at', required: 'false') }}
                                    </div>
                                    <div class="col-md-3 col-12">
                                        {{ \App\Base\Helper\Field::dateTime(name: 'filter[updated_at]', label: 'updated_at', required: 'false') }}
                                    </div>
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
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#reset-then-submit').click(function() {
                $('form')[0].reset();
                $('form').submit();
            });
        });
    </script>
@endpush
