@extends('admin.layouts.master', [
    'page_header' => __('admin.edit'),
])
@section('content')
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card p-3">
                    {{-- <div class="card-header">
                <h4 class="card-title">Hoverable rows</h4>
            </div> --}}
                    <div class="card-content">
                        <form class="form" method="POST" action="{{ route($update_route, $record->id) }}">
                            @csrf
                            @method('PUT')
                            @yield('form')
                            <hr />
                            <div class="col-12 d-flex justify-content-start">
                                <button type="submit"
                                    class="btn btn-primary me-1 mb-1">{{ __('admin_panel.submit') }}</button>
                                <button type="reset"
                                    class="btn btn-light-secondary me-1 mb-1">{{ __('admin_panel.reset') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
