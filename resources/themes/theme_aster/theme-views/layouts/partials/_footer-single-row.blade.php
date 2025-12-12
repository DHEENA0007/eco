<footer class="footer-single-row">
    <div class="container-full">
        <div class="footer-content">
            <!-- Logo -->
            <div class="footer-section footer-logo">
                <img loading="lazy" alt="{{ translate('image') }}"
                     src="{{ getStorageImages(path: $web_config['footer_logo'], type:'logo') }}">
            </div>

            <!-- Quick Links -->
            <div class="footer-section footer-links">
                <h6>{{ translate('quick_links') }}</h6>
                <div class="links-row">
                    <a href="{{ route('home') }}">{{ translate('home') }}</a>
                    @if($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0)
                        <a href="{{ route('flash-deals',[$web_config['flash_deals']['id']])}}">{{ translate('flash_deals') }}</a>
                    @endif
                    <a href="{{ route('products',['data_from'=>'featured','page'=>1])}}">{{ translate('featured_products') }}</a>
                    <a href="{{ route('products',['data_from'=>'latest']) }}">{{ translate('latest_products') }}</a>
                    <a href="{{ route('track-order.index') }}">{{ translate('track_order') }}</a>
                    <a href="{{ route('helpTopic') }}">{{ translate('FAQ') }}</a>
                </div>
            </div>

            <!-- Account -->
            <div class="footer-section footer-links">
                <h6>{{ translate('account') }}</h6>
                <div class="links-row">
                    @if(auth('customer')->check())
                        <a href="{{ route('user-profile') }}">{{ translate('profile') }}</a>
                        <a href="{{ route('account-oder') }}">{{ translate('orders') }}</a>
                        <a href="{{ route('wishlists') }}">{{ translate('wishlist') }}</a>
                    @else
                        <a href="javascript:" data-bs-toggle="modal" data-bs-target="#loginModal">{{ translate('sign_in') }}</a>
                    @endif
                    <a href="{{ route('contacts') }}">{{ translate('help_&_support') }}</a>
                </div>
            </div>

            <!-- Contact -->
            <div class="footer-section footer-contact">
                <h6>{{ translate('contact') }}</h6>
                <div class="contact-info">
                    <a href="tel:{{ $web_config['phone'] }}">
                        <i class="bi bi-telephone"></i> {{ $web_config['phone'] }}
                    </a>
                    <a href="mailto:{{$web_config['email']}}">
                        <i class="bi bi-envelope"></i> {{$web_config['email']}}
                    </a>
                </div>
            </div>

            <!-- Social Media -->
            <div class="footer-section footer-social">
                <h6>{{ translate('follow_us') }}</h6>
                <ul class="social-links">
                    @if($web_config['social_media'])
                        @foreach ($web_config['social_media'] as $item)
                            <li>
                                @if ($item->name == "twitter")
                                    <a href="{{$item->link}}" target="_blank">
                                        <svg width="18" height="18" viewBox="0 0 300 301" fill="none">
                                            <g clip-path="url(#clip0_2327_8364)">
                                                <path d="M178.57 127.849L290.27 0.699219H263.81L166.78 111.079L89.34 0.699219H0L117.13 167.629L0 300.949H26.46L128.86 184.359L210.66 300.949H300M36.01 20.2392H76.66L263.79 282.369H223.13" fill="currentColor"/>
                                            </g>
                                        </svg>
                                    </a>
                                @elseif($item->name == 'google-plus')
                                    <a href="{{$item->link}}" target="_blank">
                                        <i class="bi bi-google"></i>
                                    </a>
                                @else
                                    <a href="{{$item->link}}" target="_blank">
                                        <i class="bi bi-{{$item->name}}"></i>
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <!-- App Downloads -->
            @if((isset($web_config['android']['status']) && $web_config['android']['status']) || (isset($web_config['ios']['status']) && $web_config['ios']['status']))
                <div class="footer-section footer-apps">
                    <h6>{{ translate('download_app') }}</h6>
                    <div class="app-links">
                        @if(isset($web_config['android']['status']) && $web_config['android']['status'])
                            <a href="{{ $web_config['android']['link'] }}">
                                <img src="{{ theme_asset('assets/img/media/google-play.png') }}" loading="lazy" alt="{{ translate('image') }}">
                            </a>
                        @endif
                        @if(isset($web_config['ios']['status']) && $web_config['ios']['status'])
                            <a href="{{ $web_config['ios']['link'] }}">
                                <img src="{{ theme_asset('assets/img/media/app-store.png') }}" loading="lazy" alt="{{ translate('image') }}">
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Copyright -->
        <div class="footer-copyright">
            <div class="copyright-content">
                <p>{{ $web_config['copyright_text'] }}</p>
                @if(count($web_config['business_pages']->where('default_status', 0)) > 0)
                    <ul class="policy-links">
                        @foreach($web_config['business_pages']->where('default_status', 0) as $businessPage)
                            <li>
                                <a href="{{ route('business-page.view', ['slug' => $businessPage['slug']]) }}">
                                    {{ Str::limit($businessPage['title'], 25, '...') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</footer>
