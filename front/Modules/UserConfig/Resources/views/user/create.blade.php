@extends('layouts.master')

@section('page_title', 'User')

@section('breadcrumb')
    @php
        $breadcrumbs = ['Pengaturan User', ['User', route('admin.user_config.user.index')], 'Tambah'];
    @endphp
    @include('layouts.parts.breadcrumb', ['breadcrumbs' => $breadcrumbs])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tambah User Baru
                </div>
                <form action="{{ route('admin.user_config.user.createPost') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        @include($view . 'components.detail')
                    </div>
                    <div class="card-footer text-muted text-center">
                        <button class="btn btn-primary"><i class="fas fa-save"></i> Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('layouts.select2.init')
@push('scripts')
    <script>
        $('.select2').select2({
            placeholder: 'Pilih Peran User...'
        });
    </script>
@endpush
