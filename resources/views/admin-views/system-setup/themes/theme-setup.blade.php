@extends('layouts.admin.app')

@section('title', translate('Theme_Setup'))

@section('content')
    

        @include("admin-views.system-setup.themes._theme-modals")
    </div>

    <span id="get-theme-publish-route"
          data-action="{{ route('admin.system-setup.theme.publish') }}"></span>
    <span id="get-theme-delete-route"></span>
    <span id="get-notify-all-vendor-route-and-img-src"
          data-csrf="{{ csrf_token() }}"
          data-src="{{ dynamicAsset(path: 'public/assets/back-end/img/notify_success.png') }}"
          data-action="{{ route('admin.system-setup.theme.notify-all-the-vendors') }}">
    </span>

    @include("layouts.admin.partials.offcanvas._theme-setup")
@endsection

@push('script')
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/admin/addon.js') }}"></script>
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/admin/business-setting/theme-setup.js') }}"></script>
@endpush
