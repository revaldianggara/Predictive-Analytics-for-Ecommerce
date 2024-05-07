@extends('layouts.master')

@section('page_title', 'User')

@section('breadcrumb')
    @php
        $breadcrumbs = ['Pengaturan User', ['User', route('admin.user_config.user.index')]];
    @endphp
    @include('layouts.parts.breadcrumb', ['breadcrumbs' => $breadcrumbs])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    List User
                    <div class="card-tools ml-auto">
                        @can('create user_config.user')
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.user_config.user.createGet') }}"><i
                                    class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                        @endcan
                    </div>
                    <!-- /.card-tools -->
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th style="width: 7%">Aksi</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>
                                    @include('layouts.datatables.filter.input', [
                                        'name' => 'name[l]',
                                        'placeholder' => 'nama...',
                                    ])
                                </th>
                                <th>
                                    @include('layouts.datatables.filter.input', [
                                        'name' => 'emial[l]',
                                        'placeholder' => 'email...',
                                    ])
                                </th>
                                <th>
                                    @include('layouts.datatables.filter.datepicker', [
                                        'name' => 'created_at[l]',
                                    ])
                                </th>
                                <th>
                                    @include('layouts.datatables.filter.select_status')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('layouts.data_tables.basic_data_tables')

@push('scripts')
    <script src="{{ asset('assets/js/datatables/init_datatable.js') }}"></script>
    <script src="{{ asset('assets/js/fetch_api/fetch-post.js') }}"></script>
    <script src="{{ asset('assets/js/utils/btn-delete-item-datatable.js') }}"></script>

    <script>
        $main_datatable = init_serverside_datatable(
            '#main-table',
            "{{ route($route . 'datatable') }}",
            [{
                    data: 'name',
                },
                {
                    data: 'email',
                },
                {
                    data: 'created_at',
                },
                {
                    data: 'status',
                    sortable: false
                },
                {
                    data: 'action',
                    sortable: false,
                    className: "text-center"
                }
            ], {
                order: [3, 'desc'],
            }
        );
    </script>
@endpush
