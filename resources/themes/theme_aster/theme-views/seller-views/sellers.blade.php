@php use App\Utils\ProductManager; @endphp
@extends('theme-views.layouts.app')

@section('title', (request('filter') && request('filter') == 'top-vendors' ? translate('top_Stores') : translate('all_Stores')).' | '.$web_config['company_name'].' '.translate('ecommerce'))

@section('content')
    <main class="main-content d-flex flex-column gap-3 py-3 mb-30">
        <div class="container">
            <!-- Design Banner at Top -->
            <div class="card mb-3 text-white border-0 rounded-3 overflow-hidden" style="background: linear-gradient(45deg, #ff4500, #ffa500);">
                <div class="card-body text-center py-4 position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-8 mx-auto">
                            <h2 class="mb-3 fw-bold">{{ translate('Discover Amazing Stores') }}</h2>
                            <p class="mb-0 fs-16">{{ translate('Explore a wide variety of stores and find your favorite products with ease') }}</p>
                        </div>
                    </div>
                    <!-- Optional background pattern or image -->
                    <div class="position-absolute opacity-10" style="top: 0; right: 20px;">
                        <i class="bi bi-shop display-1"></i>
                    </div>
                </div>
            </div>
            <!-- Enhanced Header Section -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row gy-2 align-items-center">
                        <div class="col-md-8">
                            <h3 class="mb-1 text-capitalize">
                                {{ (request('filter') && request('filter') == 'top-vendors' ? translate('top_Stores') : translate('all_Stores')) }}
                            </h3>
                            <p class="fs-14 fw-semibold mb-2 text-muted">{{ translate('Find_your_desired_stores_and_shop_your_favourite_products') }}</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb fs-12 mb-0">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{translate('home')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="{{route('vendors')}}">{{translate('stores')}}</a></li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-4">
                            <div class="custom_search position-relative float-end">
                                <form action="{{ route('vendors') }}" method="get">
                                    @if(request('filter'))
                                        <input type="hidden" name="filter" value="{{ request('filter') }}">
                                    @endif
                                    <div class="d-flex">
                                        <div class="select-wrap focus-border border border-end-logical-0 d-flex align-items-center">
                                            <input type="search" class="form-control border-0 focus-input search-bar-input" name="shop_name" placeholder="{{translate('shop_name')}}" value="{{ request('shop_name') }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                                <div class="card search-card __inline-13 position-absolute z-999 bg-white top-100 start-0 search-result-box"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <p class="mb-0 text-muted">{{ $vendorsList->total() }} {{ translate('stores_found') }}</p>
                        <form action="{{ route('vendors') }}" method="get" class="d-flex gap-2 align-items-center">
                            @if(request('shop_name'))
                                <input type="hidden" name="shop_name" value="{{ request('shop_name') }}">
                            @endif
                            @if(request('filter'))
                                <input type="hidden" name="filter" value="{{ request('filter') }}">
                            @endif
                            <label for="order_by" class="form-label mb-0">{{ translate('sort_by') }}:</label>
                            <select name="order_by" id="order_by" class="form-select w-auto" onchange="this.form.submit()">
                                <option value="asc" {{ request('order_by') == 'asc' ? 'selected' : '' }}>{{ translate('name_a_to_z') }}</option>
                                <option value="desc" {{ request('order_by') == 'desc' ? 'selected' : '' }}>{{ translate('name_z_to_a') }}</option>
                                <option value="highest-products" {{ request('order_by') == 'highest-products' ? 'selected' : '' }}>{{ translate('most_products') }}</option>
                                <option value="lowest-products" {{ request('order_by') == 'lowest-products' ? 'selected' : '' }}>{{ translate('least_products') }}</option>
                                <option value="rating-high-to-low" {{ request('order_by') == 'rating-high-to-low' ? 'selected' : '' }}>{{ translate('highest_rated') }}</option>
                                <option value="rating-low-to-high" {{ request('order_by') == 'rating-low-to-high' ? 'selected' : '' }}>{{ translate('lowest_rated') }}</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Stores Grid -->
            <div class="card">
                <div class="card-body">
                    @if(count($vendorsList) > 0)
                        <div class="auto-col xxl-items-4 xl-items-3 lg-items-3 md-items-2 justify-content-center gap-3 max-sm-grid-col-1">
                            @foreach ($vendorsList as $vendor)
                                @php($currentDate = date('Y-m-d'))
                                @php($startDate = date('Y-m-d', strtotime($vendor['vacation_start_date'])))
                                @php($endDate = date('Y-m-d', strtotime($vendor['vacation_end_date'])))

                                <div class="store-card border rounded-3 overflow-hidden shadow-sm hover-shadow h-100 d-flex flex-column" style="transition: transform 0.2s; background: linear-gradient(135deg, var(--bs-light) 0%, var(--bs-body-bg) 100%);">
                                    <div class="position-relative">
                                        <!-- Store Banner -->
                                        <a href="{{route('shopView',['id' => $vendor['id']])}}" class="d-block">
                                            <img class="w-100 object-cover dark-support" style="height: 120px;" alt="{{ translate('store_banner') }}" src="{{ getStorageImages(path: $vendor->banner_full_url, type: 'shop-banner') }}" loading="lazy">
                                        </a>
                                        <!-- Top Store Badge -->
                                        @if(request('filter') == 'top-vendors')
                                            <div class="position-absolute top-0 start-0 bg-warning text-dark px-2 py-1 rounded-end">
                                                <small class="fw-bold">{{ translate('Top_Store') }}</small>
                                            </div>
                                        @endif
                                        <!-- Vacation/Temporary Close Overlay -->
                                        @if($vendor->temporary_close)
                                            <div class="position-absolute top-50 start-50 translate-middle bg-dark bg-opacity-75 text-white px-2 py-1 rounded">
                                                <small>{{translate('Temporary_OFF')}}</small>
                                            </div>
                                        @elseif($vendor->vacation_status && ($currentDate >= $startDate) && ($currentDate <= $endDate))
                                            <div class="position-absolute top-50 start-50 translate-middle bg-dark bg-opacity-75 text-white px-2 py-1 rounded">
                                                <small>{{translate('closed_Now')}}</small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-3 d-flex flex-column flex-grow-1">
                                        <!-- Store Logo and Name -->
                                        <div class="d-flex align-items-center mb-2">
                                            <img class="rounded-circle me-3 border shadow-sm dark-support" style="width: 50px; height: 50px;" alt="{{ translate('store_logo') }}" src="{{ getStorageImages(path: $vendor->image_full_url, type:'shop') }}" loading="lazy">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fw-bold">{{ $vendor->name }}</h6>
                                                <small class="text-muted">{{ $vendor['products_count'] < 1000 ? $vendor['products_count'] : number_format($vendor['products_count']/1000 , 1).'K'}} {{translate('products')}}</small>
                                            </div>
                                        </div>
                                        <!-- Rating (if available) -->
                                        @if(isset($vendor->average_rating))
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="star-rating text-warning fs-12 me-2">
                                                    @for($inc=0; $inc<5; $inc++)
                                                        @if($inc < $vendor->average_rating)
                                                            <i class="bi bi-star-fill"></i>
                                                        @else
                                                            <i class="bi bi-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <small class="text-muted">({{ $vendor->review_count ?? 0 }})</small>
                                            </div>
                                        @endif
                                        <!-- View Store Button -->
                                        <a href="{{route('shopView',['id' => $vendor['id']])}}" class="btn btn-outline-primary btn-sm mt-auto fw-bold">{{ translate('view_store') }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $vendorsList->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="w-100 text-center pt-5">
                            <img width="80" class="mb-3" src="{{ theme_asset('assets/img/empty-state/empty-vendor.svg') }}" alt="">
                            <h5 class="text-center text-muted">{{ translate('there_is_no_vendor') }}.</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
