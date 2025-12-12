@extends('theme-views.layouts.app')

@section('title', translate('all_Brands_Page').' | '.$web_config['company_name'].' '.translate('ecommerce'))

@section('content')
    <main class="main-content d-flex flex-column gap-3 py-3 mb-30">
        <div class="container">
            <!-- Design Banner at Top -->
            <div class="card mb-3 text-white border-0 rounded-3 overflow-hidden" style="background: linear-gradient(45deg, #ff4500, #ffa500);">
                <div class="card-body text-center py-4 position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-8 mx-auto">
                            <h2 class="mb-3 fw-bold">{{ translate('Discover Amazing Brands') }}</h2>
                            <p class="mb-0 fs-16">{{ translate('Explore a wide variety of brands and find your favorite products with ease') }}</p>
                        </div>
                    </div>
                    <!-- Optional background pattern or image -->
                    <div class="position-absolute opacity-10" style="top: 0; right: 20px;">
                        <i class="bi bi-tag-fill display-1"></i>
                    </div>
                </div>
            </div>
            <!-- Location Indicator (if pincode is set) -->
            @if(isset($userPincode) && $userPincode)
            <div class="alert alert-info d-flex align-items-center justify-content-between mb-3" role="alert">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-geo-alt-fill fs-5"></i>
                    <div>
                        <strong>{{ translate('showing_brands_for_pincode') }}: {{ $userPincode }}</strong>
                    </div>
                </div>
                <a href="{{ route('account-address-add') }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-pencil-square me-1"></i>{{ translate('change_location') }}
                </a>
            </div>
            @endif

            <!-- Enhanced Header Section -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row gy-2 align-items-center">
                        <div class="col-md-6">
                            <h3 class="mb-1 text-capitalize">{{ translate('all_brands') }}</h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb fs-12 mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ translate('home') }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ translate('brands') }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-md-end">
                                <div class="border rounded custom-ps-3 py-2">
                                    <div class="d-flex gap-2">
                                        <div class="flex-middle gap-2">
                                            <i class="bi bi-sort-up-alt"></i>
                                            {{ translate('show_brand :') }}
                                        </div>
                                        <div class="dropdown">
                                            <button type="button" class="border-0 bg-transparent dropdown-toggle p-0 custom-pe-3" data-bs-toggle="dropdown" aria-expanded="false">
                                                @if(request('order_by') == 'desc')
                                                    {{ translate('Z-A') }}
                                                @elseif(request('order_by') == 'asc')
                                                    {{ translate('A-Z') }}
                                                @else
                                                    {{ translate('Default') }}
                                                @endif
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="d-flex" href="{{ route('brands') }}">
                                                        {{ translate('Default') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="d-flex" href="{{ route('brands') }}/?order_by=asc">
                                                        {{ translate('A-Z') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="d-flex" href="{{ route('brands') }}/?order_by=desc">
                                                        {{ translate('Z-A') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="auto-col xxl-items-6 justify-content-center gap-3 max-sm-grid-col-2">
                        @foreach($brands as $brand)
                        <div class="brand-item grid-center border rounded-3 overflow-hidden shadow-sm hover-shadow h-100 d-flex flex-column" style="background: linear-gradient(135deg, var(--bs-light) 0%, var(--bs-body-bg) 100%); transition: transform 0.2s; padding: 1rem;">
                            <div class="hover__action">
                                <a href="{{route('products',['brand_id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}" class="eye-btn mx-auto mb-3">
                                    <i class="bi bi-eye fs-12"></i>
                                </a>
                                <div class="d-flex flex-column flex-wrap gap-1 text-white">
                                    <h6 class="text-white">{{$brand->brand_products_count}}</h6>
                                    <p>{{translate('Products')}}</p>
                                </div>
                            </div>
                            <img width="130" loading="lazy" class="dark-support rounded text-center aspect-1 object-contain"
                                 src="{{ getStorageImages(path:$brand->image_full_url, type:'brand') }}" alt="{{ $brand->image_alt_text ?? $brand->name}}">
                            <h6 class="mt-2 text-center">{{$brand->name}}</h6>
                        </div>
                        @endforeach
                    </div>

                    @if($brands->count()==0)
                        <div class="d-flex flex-column justify-content-center align-items-center gap-2 py-3 w-100">
                            <img width="80" class="mb-3" src="{{ theme_asset('assets/img/empty-state/empty-brand.svg') }}" alt="">
                            <h5 class="text-center text-muted">{{ translate('there_is_no_Brand') }}.</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-footer border-0">
            {{$brands->links() }}
        </div>
    </main>
@endsection
