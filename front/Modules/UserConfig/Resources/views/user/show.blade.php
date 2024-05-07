@extends('layouts.master')

@section('page_title', 'User')

@section('breadcrumb')
    @php
        $breadcrumbs = ['Pengaturan User', ['User', route('admin.user_config.user.index')], 'Detail'];
    @endphp
    @include('layouts.parts.breadcrumb', ['breadcrumbs' => $breadcrumbs])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Detail User
                </div>
                <div class="card-body">
                    <fieldset disabled>
                        @include($view . 'components.detail')
                    </fieldset>
                </div>
                @if ($data['obj']->id !== auth()->user()->id)
                    <div class="card-footer text-muted text-center">
                        @if ($data['obj']->trashed())
                            @can('restore user_config.user')
                                <a class="btn btn-danger btn-info"
                                    href="{{ route('admin.user_config.user.restore', ['id' => $data['obj']->id]) }}"
                                    data-toggle="tooltip" data-placement="top" title="Hapus"
                                    onclick="return confirm('Yakin Mengembalikan?')"><i class="far fa-trash-alt"></i>
                                    Kembalikan</a>
                            @endcan
                        @else
                            @can('Super-Admin')
                                <a class="btn btn-warning"
                                    href="{{ route('admin.user_config.user.login.as.user', ['id' => $data['obj']->id]) }}"
                                    data-toggle="tooltip" data-placement="top" title="Login Sebagai {{ $data['obj']->name }}"
                                    onclick="return confirm('Yakin Login Sebagai {{ $data['obj']->name }}')"><i
                                        class="fa fa-key"></i> Login</a>
                            @endcan
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@include('layouts.select2.init')
@push('scripts')
    <script>
        $('.select2').select2({
            placeholder: 'Pilih Peran User...',
            disabled: true
        });

        $("#password").closest(".form-group").hide();
    </script>
@endpush
