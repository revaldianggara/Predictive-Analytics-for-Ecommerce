@extends('layouts.master')

@section('page_title', 'User')

@section('breadcrumb')
    @php
        $breadcrumbs = ['Pengaturan User', ['User', route('admin.user_config.user.index')], 'Edit'];
    @endphp
    @include('layouts.parts.breadcrumb', ['breadcrumbs' => $breadcrumbs])
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <form action="{{ route('admin.user_config.user.update', ['id' => $data['obj']->id]) }}" method="POST"
                autocomplete="off" class="card-body">
                <div class="card">
                    <div class="card-header">
                        Edit User {{ $data['obj']->name }}
                    </div>
                    @csrf
                    <div class="card-body">
                        @include($view . 'components.detail')
                    </div>
                    <div class="card-footer text-muted text-center">
                        <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('layouts.general_informations.userResponsibleStamp', ['data' => $data['obj']])
@endsection

@include('layouts.select2.init')
@push('scripts')
    <script>
        $('.select2').select2();

        $("#username").attr('disabled', true);
    </script>
@endpush
