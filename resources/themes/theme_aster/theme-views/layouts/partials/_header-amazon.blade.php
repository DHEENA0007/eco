@php
    use App\Models\Brand;
    use App\Models\Category;
    use App\Utils\Helpers;
@endphp
@if (isset($web_config['announcement']) && $web_config['announcement']['status']==1)
    <div class="offer-bar py-2 py-sm-3 announcement-color d--none">
        <div class="d-flex gap-2 align-items-center">
            <div class="offer-bar-close">
                <i class="bi bi-x-lg"></i>
            </div>
            <div class="top-offer-text flex-grow-1 d-flex justify-content-center fw-semibold ">
                {{ $web_config['announcement']['announcement'] }}
            </div>
        </div>
    </div>
@endif

@php($categories = \App\Utils\CategoryManager::getCategoriesWithCountingAndPriorityWiseSorting(dataLimit: 11))
@php($brands = \App\Utils\BrandManager::getActiveBrandWithCountingAndPriorityWiseSorting())
<header class="header">
    <!-- Amazon-Style Single Container Header -->
    <div class="header-amazon-single py-2 d-none d-xl-block bg-dark" style="background-color: #000000 !important;">
        <div class="container-fluid">
            <div class="d-flex align-items-center gap-3">
                <!-- Logo (Fixed Left) -->
                <div class="flex-shrink-0" style="width: 140px;">
                    <a class="logo d-block" href="{{route('home')}}">
                        <img class="dark-support svg h-45" alt="{{ translate('Logo') }}"
                             src="{{ getStorageImages(path: $web_config['web_logo'], type:'logo') }}">
                    </a>
                </div>

                <div class="flex-grow-1"></div>

                <!-- Search Box (Centered) -->
                <div class="bg-white rounded shadow-sm p-1" style="max-width: 800px;">
                    <div class="search-box position-relative">
                        <form action="{{route('products')}}" type="submit">
                            <div class="d-flex rounded overflow-hidden border-0">
                                <div class="select-wrap d-flex align-items-center bg-light">
                                    <div class="dropdown search_dropdown">
                                        <button type="button"
                                                class="border-0 px-3 py-2 bg-transparent dropdown-toggle text-dark text-capitalize header-search-dropdown-button fs-13 fw-normal"
                                                data-bs-toggle="dropdown" aria-expanded="false" data-default="{{ translate('all_categories') }}" style="white-space: nowrap;">
                                            @if($categories && request('category_ids') && !empty(request('category_ids')))
                                                @foreach($categories as $category)
                                                    @if(in_array($category->id, request('category_ids') ?? []))
                                                        {{ Str::limit($category['name'], 10) }}
                                                    @endif
                                                @endforeach
                                            @else
                                                {{ translate('all_categories') }}
                                            @endif
                                        </button>
                                        <input type="hidden" name="category_ids[]" id="search_category_value"
                                               @if($categories && request('category_ids') && !empty(request('category_ids')))
                                                   @foreach($categories as $category)
                                                       @if(in_array($category->id, request('category_ids') ?? []))
                                                           value="{{ $category->id }}"
                                                       @endif
                                                   @endforeach
                                               @else
                                                   value="{{ 'all' }}"
                                               @endif
                                        >
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="d-flex text-capitalize" data-value="all" href="javascript:">
                                                    {{ translate('all_categories') }}
                                                </a>
                                            </li>
                                            @if($categories)
                                                @foreach($categories as $category)
                                                    <li>
                                                        <a class="d-flex" data-value="{{ $category->id }}"
                                                           href="javascript:">
                                                            {{ $category['name'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <input
                                    type="search"
                                    class="form-control border-0 py-2 search-bar-input bg-white" name="product_name"
                                    id="global-search" value="{{ request('product_name') }}"
                                    placeholder="{{ translate('search_for_items').'...' }}"
                                    style="outline: none; box-shadow: none;"
                                />
                                <input name="data_from" value="search" hidden>
                                <input type="hidden" name="global_search_input" value="1">
                                <input name="page" value="1" hidden>
                                <button type="submit" class="btn btn-warning px-4 border-0" aria-label="{{ translate('Search') }}" style="border-radius: 0;">
                                    <i class="bi bi-search fs-16"></i>
                                </button>
                            </div>
                        </form>
                        <div class="search-result-box position-absolute w-100 bg-white start-0 rounded shadow-lg border-0" style="top: calc(100% + 5px); z-index: 1050; max-height: 500px; overflow-y: auto; display: none;"></div>
                    </div>
                </div>

                <div class="flex-grow-1"></div>

                <!-- Right Side Icons & Controls -->
                <div class="flex-shrink-0" style="margin-right: 20px;">
                    <div class="d-flex align-items-center gap-2">
                        <!-- Language Dropdown -->
                        <div class="language-dropdown">
                            <button
                                type="button"
                                class="border-0 bg-transparent d-flex flex-column align-items-start dropdown-toggle text-white p-1 lh-sm"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <span class="fs-11 opacity-75">Language</span>
                                <span class="fs-13 fw-bold d-flex align-items-center gap-1">
                                    <i class="bi bi-globe fs-14"></i>
                                    @php( $local = Helpers::default_lang())
                                    @foreach($web_config['language'] as $data)
                                        @if($data['code']==$local)
                                            {{ ucwords($data['name']) }}
                                        @endif
                                    @endforeach
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bs-dropdown-min-width--10rem">
                                @foreach($web_config['language'] as $key =>$data)
                                    @if($data['status']==1)
                                        <li class="change-language" data-action="{{route('change-language')}}" data-language-code="{{$data['code']}}">
                                            <a class="d-flex gap-2 align-items-center" href="javascript:">
                                                <img width="18" src="{{theme_asset('assets/img/flags')}}/{{ $data['code'].'.png' }}"
                                                     loading="lazy" class="dark-support" alt="{{$data['name']}}"/>
                                                {{ ucwords($data['name']) }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <!-- Currency Dropdown -->
                        @if($web_config['currency_model']=='multi_currency')
                            <div class="language-dropdown">
                                <button
                                    type="button"
                                    class="border-0 bg-transparent d-flex flex-column align-items-start dropdown-toggle text-white p-1 lh-sm"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <span class="fs-11 opacity-75">Currency</span>
                                    <span class="fs-13 fw-bold d-flex align-items-center gap-1">
                                        <i class="bi bi-coin fs-14"></i>
                                        {{session('currency_code')}}
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end bs-dropdown-min-width--10rem">
                                    @foreach ($web_config['currencies'] as $key => $currency)
                                        <li class="currency-change" data-currency-code="{{$currency['code']}}">
                                            <a href="javascript:">{{ $currency->name }}</a>
                                        </li>
                                    @endforeach
                                    <span id="currency-route" data-currency-route="{{route('currency.change')}}"></span>
                                </ul>
                            </div>
                        @endif

                        <!-- Account -->
                        @if(auth('customer')->check())
                            <div class="profile-dropdown">
                                <button
                                    type="button"
                                    class="border-0 bg-transparent d-flex flex-column align-items-start dropdown-toggle text-white p-1 lh-sm"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    title="{{ translate('account') }}"
                                >
                                    <span class="fs-11 opacity-75">Hello, {{ Str::limit(getCustomerFromQuery()->f_name ?? 'User', 8) }}</span>
                                    <span class="fs-13 fw-bold">Account & Lists</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end bs-dropdown-min-width--10rem header-dropdown">
                                    <li><a href="{{route('account-oder')}}">{{ translate('My_Order') }}</a></li>
                                    <li><a href="{{route('user-profile')}}">{{ translate('My_Profile') }}</a></li>
                                    <li><a href="{{route('customer.auth.logout')}}">{{ translate('Logout') }}</a></li>
                                </ul>
                            </div>
                        @else
                            <button
                                class="border-0 bg-transparent d-flex flex-column align-items-start text-white p-1 lh-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#loginModal"
                                title="{{ translate('login') }}"
                            >
                                <span class="fs-11 opacity-75">Hello, Sign in</span>
                                <span class="fs-13 fw-bold">Account & Lists</span>
                            </button>
                        @endif

                        <!-- Returns & Orders -->
                        <a href="{{auth('customer')->check() ? route('account-oder') : 'javascript:'}}"
                           class="text-decoration-none text-white d-flex flex-column align-items-start p-1 lh-sm"
                           @if(!auth('customer')->check()) data-bs-toggle="modal" data-bs-target="#loginModal" @endif>
                            <span class="fs-11 opacity-75">Returns</span>
                            <span class="fs-13 fw-bold">& Orders</span>
                        </a>

                        <!-- Compare -->
                        @if(auth('customer')->check())
                            <a href="{{ route('product-compare.index') }}" class="position-relative text-decoration-none d-flex align-items-center p-1 header-icon-gold" title="{{ translate('compare') }}">
                                <i class="bi bi-repeat fs-20"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill fs-10 header-badge-gold" style="margin-left: -10px;">
                                    {{session()->has('compare_list') ? count(session('compare_list')) : 0}}
                                </span>
                            </a>
                        @else
                            <a href="javascript:" class="position-relative text-decoration-none d-flex align-items-center p-1 header-icon-gold" data-bs-toggle="modal"
                               data-bs-target="#loginModal" title="{{ translate('compare') }}">
                                <i class="bi bi-repeat fs-20"></i>
                            </a>
                        @endif

                        <!-- Wishlist -->
                        @if(auth('customer')->check())
                            <a href="{{ route('wishlists') }}" class="position-relative text-decoration-none d-flex align-items-center p-1 header-icon-gold" title="{{ translate('wishlist') }}">
                                <i class="bi bi-heart fs-20"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger fs-10" style="margin-left: -10px;">
                                    {{session()->has('wish_list') ? count(session('wish_list')):0}}
                                </span>
                            </a>
                        @else
                            <a href="javascript:" class="position-relative text-decoration-none d-flex align-items-center p-1 header-icon-gold" data-bs-toggle="modal"
                               data-bs-target="#loginModal" title="{{ translate('wishlist') }}">
                                <i class="bi bi-heart fs-20"></i>
                            </a>
                        @endif

                        <!-- Cart -->
                        <div id="cart_items">
                            @include('theme-views.layouts.partials._cart')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Row (Second Row within Same Container) -->
            <div class="d-flex align-items-center gap-3 flex-wrap mt-2">
                        <!-- All Categories Menu -->
                        <div class="dropdown">
                            <button class="btn btn-light d-flex align-items-center gap-2 px-3 py-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-list fs-20"></i>
                                <span class="fw-semibold">All</span>
                            </button>
                            <ul class="dropdown-menu">
                                @if($categories)
                                    @foreach($categories as $category)
                                        <li><a class="dropdown-item" href="{{route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])}}">{{ $category['name'] }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <!-- Main Navigation Links -->
                        <ul class="nav main-menu align-items-center d-flex flex-nowrap gap-2 mb-0">
                            <li class="{{request()->is('/')?'active':''}}">
                                <a href="{{route('home')}}" class="text-decoration-none fw-normal fs-14 header-nav-gold">{{ translate('home')}}</a>
                            </li>
                            @if(getFeaturedDealsProductList()->count() > 0 || ($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0) || $web_config['discount_product'] > 0)
                                <li class="dropdown">
                                    <span class="cursor-pointer no-follow-link fw-normal fs-14 header-nav-gold" data-bs-toggle="dropdown" ref="nofollow">{{ translate('offers')}}</span>
                                    <ul class="dropdown-menu">
                                        @if(getFeaturedDealsProductList()->count()>0)
                                            <li>
                                                <a class="dropdown-item text-capitalize"
                                                   href="{{route('products',['offer_type'=>'featured_deal'])}}">{{ translate('featured_deal') }}</a>
                                            </li>
                                        @endif
                                        @if($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0)
                                            <li>
                                                <a class="dropdown-item text-capitalize"
                                                   href="{{route('flash-deals',[$web_config['flash_deals']['id']??0])}}">{{ translate('flash_deal') }}</a>
                                            </li>
                                        @endif
                                        @if ($web_config['discount_product'] > 0)
                                            <li>
                                                <a class="dropdown-item text-capitalize" href="{{ route('products',['offer_type'=>'discounted','page'=>1]) }}">
                                                    {{ translate('discounted_products') }}
                                                </a>
                                            </li>
                                        @endif
                                        @if($web_config['clearance_sale_product_count'] > 0)
                                            <li>
                                                <a class="dropdown-item" href="{{ route('products',['offer_type'=>'clearance_sale','page'=>1]) }}">
                                                    {{ translate('clearance_sale') }}
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            @if($web_config['business_mode'] == 'multi')
                                <li class="dropdown">
                                    <span class="cursor-pointer no-follow-link fw-normal fs-14 header-nav-gold" data-bs-toggle="dropdown" ref="nofollow">{{ translate('stores') }}</span>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{route('shopView',['id'=>0])}}">{{ Str::limit($web_config['company_name'], 20) }}</a></li>
                                        @foreach($web_config['shops'] as $shop)
                                            <li><a class="dropdown-item" href="{{route('shopView',['id' => $shop['id']])}}">{{Str::limit($shop->name, 20)}}</a></li>
                                        @endforeach
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-primary" href="{{route('vendors')}}">{{ translate('view_all') }}</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if($web_config['brand_setting'])
                                <li class="dropdown">
                                    <span class="cursor-pointer no-follow-link fw-normal fs-14 header-nav-gold" data-bs-toggle="dropdown" ref="nofollow">{{ translate('brands') }}</span>
                                    <ul class="dropdown-menu">
                                        @php($brandIndex=0)
                                        @foreach($brands as $brand)
                                            @php($brandIndex++)
                                            @if($brandIndex < 10)
                                                <li><a class="dropdown-item" href="{{ route('products',['brand_id'=> $brand['id'],'data_from'=>'brand','page'=>1]) }}">{{ $brand->name }}</a></li>
                                            @endif
                                        @endforeach
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-primary" href="{{route('brands')}}">{{ translate('view_all') }}</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if($web_config['business_mode'] == 'multi' && $web_config['seller_registration'])
                                <li>
                                    <a href="{{route('vendor.auth.registration.index')}}" class="text-decoration-none fw-normal fs-14 text-capitalize header-nav-gold">
                                        {{ translate('become_a_vendor')}}
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <!-- Header Banner -->
                        @if($web_config['header_banner'])
                            <div class="ms-auto">
                                <a href="{{ $web_config['header_banner']['url'] }}">
                                    <img width="160" loading="lazy" class="dark-support img-fit" alt="{{ translate('image') }}" style="max-height: 45px;"
                                        src="{{ getStorageImages(path: $web_config['header_banner']['photo_full_url'], type:'wide-banner') }}">
                                </a>
                            </div>
                        @endif
            </div>
        </div>
    </div>

    <!-- Mobile Header -->
    <div class="header-mobile py-2 shadow-sm d-xl-none">
        <div class="container-fluid px-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="menu-btn d-flex align-items-center">
                    <i class="bi bi-list fs-30"></i>
                </div>
                <a class="logo flex-grow-1 text-center" href="{{route('home')}}">
                    <img class="dark-support mobile-logo-cs" alt="{{ translate('logo') }}"
                         src="{{ getStorageImages(path: $web_config['mob_logo'], type:'logo') }}" style="max-height: 40px;">
                </a>
                <div class="d-flex gap-2 align-items-center">
                    <div class="menu-btn search">
                        <i class="bi bi-search fs-18"></i>
                    </div>
                    <div class="profile-dropdown">
                        @if(auth('customer')->check())
                            <span class="avatar header-avatar rounded-circle d-flex size-1-5rem">
                                @php($profileImg = getCustomerFromQuery() ? getCustomerFromQuery()->image_full_url : '')
                                <img loading="lazy" class="img-fit" alt="{{ translate('image') }}"
                                  src="{{ getStorageImages(path: $profileImg, type:'avatar') }}">
                            </span>
                        @else
                            <span class="avatar header-avatar rounded-circle d-flex size-1-5rem">
                                <img loading="lazy"
                                    src="{{theme_asset('assets/img/user.png')}}"
                                    class="img-fit rounded-circle"
                                    alt="{{translate('image')}}"
                                />
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar Menu -->
    <aside class="aside d-flex flex-column d-xl-none">
        <div class="aside-close p-3 pb-2">
            <i class="bi bi-x-lg"></i>
        </div>
        <div>
            <div class="aside-body" data-trigger="scrollbar">
                <form action="{{route('products')}}" class="mb-3">
                    <div class="search-bar">
                        <input type="search" name="name" class="form-control search-bar-input-mobile"
                               autocomplete="off" placeholder="{{ translate('search_for_items').'...' }}">
                        <input name="data_from" value="search" hidden="">
                        <input name="page" value="1" hidden="">
                        <button type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <div
                        class="card search-card __inline-13 position-absolute z-99 w-100 bg-white start-0 search-result-box d--none"></div>
                </form>
                <ul class="main-nav nav">
                    <li>
                        <a href="{{route('home')}}">{{ translate('home') }}</a>
                    </li>
                    <li>
                        <a href="{{route('categories')}}">{{ translate('categories') }}</a>
                        <ul class="sub_menu">
                            @php($categoryIndex=0)
                            @foreach($categories as $category)
                                @php($categoryIndex++)
                                @if($categoryIndex < 10)
                                    <li>
                                        <a href="javascript:">
                                            <span class="get-view-by-onclick"
                                                data-link="{{route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])}}">{{ $category['name'] }}</span>
                                        </a>
                                        @if ($category->childes->count() > 0)
                                            <ul class="sub_menu">
                                                @foreach($category['childes'] as $subCategory)
                                                    <li>
                                                        <a href="javascript:">
                                                            <span class="get-view-by-onclick" data-link="{{route('products',['sub_category_id'=> $subCategory['id'],'data_from'=>'category','page'=>1])}}">{{$subCategory['name']}}</span>
                                                        </a>
                                                        @if($subCategory->childes->count()>0)
                                                            <ul class="sub_menu">
                                                                @foreach($subCategory['childes'] as $subSubCategory)
                                                                    <li>
                                                                        <a href="{{route('products',['sub_sub_category_id'=> $subSubCategory['id'],'data_from'=>'category','page'=>1])}}">
                                                                            {{$subSubCategory['name']}}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                            <li>
                                <a href="{{route('products', ['data_from'=>'latest'])}}" class="btn-link text-primary">
                                    {{ translate('view_all') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(getFeaturedDealsProductList()->count() > 0 || ($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0) || $web_config['discount_product'] > 0 || $web_config['clearance_sale_product_count'] > 0)
                        <li>
                            <a href="javascript:">{{ translate('offers') }}</a>
                            <ul class="sub_menu">
                                @if(getFeaturedDealsProductList()->count() > 0)
                                    <li>
                                        <a href="{{route('products',['offer_type'=>'featured_deal'])}}">{{ translate('featured_Deal') }}</a>
                                    </li>
                                @endif

                                @if($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0)
                                    <li>
                                        <a href="{{route('flash-deals',[ $web_config['flash_deals']['id'] ?? 0])}}">{{ translate('flash_deal') }}</a>
                                    </li>
                                @endif
                                @if ($web_config['discount_product'] > 0)
                                    <li>
                                        <a class="d-flex gap-2 align-items-center" href="{{ route('products',['offer_type'=>'discounted','page'=>1]) }}">
                                            <span>{{ translate('discounted_products') }}</span>
                                            <span><i class="bi bi-patch-check-fill text-warning"></i></span>
                                        </a>
                                    </li>
                                @endif
                                @if($web_config['clearance_sale_product_count'] > 0)
                                    <li>
                                        <a class="gap-2 align-items-center" href="{{ route('products', ['offer_type' => 'clearance_sale', 'page' => 1]) }}">
                                            <span>{{ translate('clearance_sale') }}</span>
                                            <span><i class="bi bi-patch-check-fill text-warning"></i></span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if($web_config['business_mode'] == 'multi')
                        <li>
                            <a href="javascript:">{{ translate('stores') }}</a>
                            <ul class="sub_menu">
                                <li>
                                    <a href="{{ route('shopView',['id'=>0]) }}">
                                        {{ Str::limit($web_config['company_name'], 14) }}
                                    </a>
                                </li>
                                @foreach($web_config['shops'] as $shop)
                                    <li>
                                        <a href="{{route('shopView',['id'=>$shop['seller_id']])}}">{{Str::limit($shop->name, 14)}}</a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{route('vendors')}}" class="btn-link text-primary">
                                        {{ translate('view_all') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if($web_config['brand_setting'])
                        <li>
                            <a href="javascript:">{{ translate('brands') }}</a>
                            <ul class="sub_menu">
                                @php($brandIndex=0)
                                @foreach($brands as $brand)
                                    @php($brandIndex++)
                                    @if($brandIndex < 10)
                                        <li>
                                            <a href="{{ route('products',['brand_id'=> $brand['id'],'data_from'=>'brand','page'=>1]) }}">{{ $brand->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                                <li>
                                    <a href="{{route('brands')}}" class="btn-link text-primary">
                                        {{ translate('view_all') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if ($web_config['digital_product_setting'] && count($web_config['publishing_houses']) == 1)
                        <li>
                            <a class="d-flex gap-2 align-items-center text-capitalize"
                               href="{{ route('products',['publishing_house_id' => 0, 'product_type' => 'digital', 'page'=>1]) }}">
                                {{ translate('Publication_House')}}
                            </a>
                        </li>
                    @elseif ($web_config['digital_product_setting'] && count($web_config['publishing_houses']) > 1)
                        <li>
                            <a class="d-flex gap-2 align-items-center text-capitalize"
                               href="{{ route('products', ['product_type' => 'digital', 'page'=>1]) }}">
                                {{ translate('Publication_House')}}
                            </a>
                        </li>
                    @endif
                    @if($web_config['business_mode'] == 'multi' &&  $web_config['seller_registration'])
                        <li class="d-xl-none">
                            <a href="{{route('vendor.auth.registration.index')}}" class="d-flex text-capitalize">
                                <div class="fz-16 text-capitalize">{{ translate('become_a_vendor')}}</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="d-flex align-items-center gap-2 justify-content-between p-4">
                <span class="text-dark">{{ translate('theme_mode') }}</span>
                <div class="theme-bar p-1">
                    <button class="light_button active">
                        <img src="{{theme_asset('assets/img/svg/light.svg')}}" alt="{{translate('image')}}"
                             class="svg">
                    </button>
                    <button class="dark_button">
                        <img src="{{theme_asset('assets/img/svg/dark.svg')}}" alt="{{translate('image')}}"
                             class="svg">
                    </button>
                </div>
            </div>
        </div>

        @if(auth('customer')->check())
            <div class="d-flex justify-content-center mb-5 pb-5 mt-auto px-4">
                <a href="{{route('customer.auth.logout')}}"
                   class="btn btn-primary w-100">{{ translate('logout') }}</a>
            </div>
        @else
            <div class="d-flex justify-content-center mb-5 pb-5 mt-auto px-4">
                <a href="" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary w-100" aria-label="{{ translate('login').'/'.translate('register')}}">
                    {{ translate('login').'/'.translate('register')}}
                </a>
            </div>
        @endif
    </aside>
    <div class="aside-overlay"></div>

    @include('theme-views.partials._vertical-categories')
</header>
