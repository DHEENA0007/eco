@php
    use App\Utils\Helpers;
@endphp
<style>
    .banner-slider-wrapper {
        position: relative;
    }

    .banner-nav-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1000 !important;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        pointer-events: auto;
    }

    .swiper {
        z-index: 1;
    }

    .banner-nav-button:hover {
        background: rgba(255, 255, 255, 1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        transform: translateY(-50%) scale(1.1);
    }

    .banner-nav-button i {
        font-size: 20px;
        color: #333;
    }

    .banner-nav-prev {
        left: 30px;
    }

    .banner-nav-next {
        right: 30px;
    }

    .banner-slider-wrapper .swiper-container {
        position: relative;
    }

    .banner-cta-button {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        padding: 12px 30px;
        background: var(--bs-primary);
        color: #fff;
        text-decoration: none;
        border-radius: 25px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        display: inline-block;
    }

    .banner-cta-button:hover {
        background: var(--bs-primary);
        color: #fff;
        transform: translateX(-50%) translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
        text-decoration: none;
    }

    /* Dark Theme Support */
    [theme="dark"] .banner-nav-button {
        background: rgba(45, 45, 45, 0.9);
    }

    [theme="dark"] .banner-nav-button:hover {
        background: rgba(45, 45, 45, 1);
    }

    [theme="dark"] .banner-nav-button i {
        color: #e0e0e0;
    }

    /* Dark Theme Support for CTA Button */
    [theme="dark"] .banner-cta-button {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #000000;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6), 0 0 8px rgba(255, 215, 0, 0.3);
    }

    [theme="dark"] .banner-cta-button:hover {
        background: linear-gradient(135deg, #FFA500 0%, #FF8C00 100%);
        color: #000000;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.8), 0 0 12px rgba(255, 215, 0, 0.5);
    }

    @media (max-width: 768px) {
        .banner-nav-button {
            width: 35px;
            height: 35px;
        }

        .banner-nav-button i {
            font-size: 16px;
        }

        .banner-nav-prev {
            left: 10px;
        }

        .banner-nav-next {
            right: 10px;
        }

        .banner-cta-button {
            bottom: 15px;
            padding: 10px 20px;
            font-size: 14px;
        }
    }
</style>

<section class="banner">
    <div class="container">
        <div class="banner-slider-wrapper">
            <div class="swiper-container shadow-sm rounded" style="aspect-ratio: 21/9; position: relative;">
                <!-- Navigation Buttons -->
                @if(isset($bannerTypeMainBanner) && count($bannerTypeMainBanner) >= 1)
                    <button class="banner-nav-button banner-nav-prev" type="button" aria-label="{{ translate('Previous') }}">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="banner-nav-button banner-nav-next" type="button" aria-label="{{ translate('Next') }}">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                @endif

                <div class="swiper banner-swiper" data-swiper-loop="true">
                    <div class="swiper-wrapper">
                        @if(isset($bannerTypeMainBanner) && count($bannerTypeMainBanner) > 0)
                            @foreach($bannerTypeMainBanner as $key=>$banner)
                                <div class="swiper-slide" data-banner-url="{{ $banner['url'] ?? '#' }}">
                                    <div class="position-relative h-100">
                                        <img loading="lazy" alt="{{ $banner['title'] ?? 'Banner' }}"
                                             class="dark-support rounded w-100 h-100 object-fit-cover"
                                             src="{{ getStorageImages(path: $banner['photo_full_url'] ?? null, type:'banner') }}">
                                        @if(!empty($banner['url']))
                                            <a href="{{ $banner['url'] }}" class="banner-cta-button">
                                                {{ !empty($banner['button_text']) ? $banner['button_text'] : translate('Shop_Now') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide">
                                <img src="{{ theme_asset('assets/img/placeholder/placeholder-2-1.png') }}"
                                     loading="lazy" alt="Placeholder" class="dark-support rounded w-100 h-100 object-fit-cover">
                            </div>
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const bannerSwiper = document.querySelector('.banner-swiper');
    if (!bannerSwiper) return;

    // Count slides
    const slideCount = bannerSwiper.querySelectorAll('.swiper-slide').length;

    // Initialize Swiper
    const swiper = new Swiper('.banner-swiper', {
        loop: slideCount > 1,
        autoplay: slideCount > 1 ? {
            delay: 5000,
            disableOnInteraction: false,
        } : false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.banner-nav-next',
            prevEl: '.banner-nav-prev',
        },
        effect: 'slide',
        speed: 600,
        allowTouchMove: slideCount > 1,
    });

    // Hide navigation buttons if only one slide
    if (slideCount <= 1) {
        const prevBtn = document.querySelector('.banner-nav-prev');
        const nextBtn = document.querySelector('.banner-nav-next');
        if (prevBtn) prevBtn.style.display = 'none';
        if (nextBtn) nextBtn.style.display = 'none';
    }
});
</script>
