<!-- Horizontal Categories Tags -->
@php
    use App\Utils\Helpers;
@endphp
<style>
    /* Light and Dark Theme Support */
    .amazon-horizontal-categories {
        background: var(--bs-body-bg, #fff);
        border-bottom: 1px solid var(--bs-border-color, #e5e5e5);
        padding: 10px 0;
        position: sticky;
        top: 0;
        z-index: 100;
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .amazon-categories-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
        padding: 0 15px;
    }

    .amazon-category-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: var(--bs-secondary-bg, #f0f2f5);
        border-radius: 20px;
        text-decoration: none;
        color: var(--bs-body-color, #333);
        font-size: 13px;
        transition: all 0.2s ease;
        white-space: nowrap;
        border: 1px solid transparent;
    }

    .amazon-category-tag:hover {
        background: var(--bs-tertiary-bg, #e4e6eb);
        color: var(--bs-emphasis-color, #000);
        text-decoration: none;
        border-color: var(--bs-border-color-translucent, #d0d0d0);
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .category-tag-icon {
        width: 18px;
        height: 18px;
        object-fit: cover;
        border-radius: 50%;
        flex-shrink: 0;
        background: var(--bs-body-bg, #fff);
    }

    /* Dark Theme Specific Styles */
    [data-bs-theme="dark"] .amazon-horizontal-categories,
    .dark-theme .amazon-horizontal-categories {
        background: var(--bs-dark, #1a1a1a);
        border-bottom-color: var(--bs-border-color, #404040);
    }

    [data-bs-theme="dark"] .amazon-category-tag,
    .dark-theme .amazon-category-tag {
        background: var(--bs-secondary-bg, #2d2d2d);
        color: var(--bs-body-color, #e0e0e0);
        border-color: transparent;
    }

    [data-bs-theme="dark"] .amazon-category-tag:hover,
    .dark-theme .amazon-category-tag:hover {
        background: var(--bs-tertiary-bg, #3d3d3d);
        color: var(--bs-emphasis-color, #fff);
        border-color: var(--bs-border-color, #505050);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    [data-bs-theme="dark"] .category-tag-icon,
    .dark-theme .category-tag-icon {
        background: var(--bs-secondary-bg, #2d2d2d);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    @media (max-width: 768px) {
        .amazon-categories-tags {
            overflow-x: auto;
            flex-wrap: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .amazon-categories-tags::-webkit-scrollbar {
            display: none;
        }
    }
</style>

<div class="amazon-horizontal-categories" id="horizontal-categories-bar">
    <div class="amazon-categories-tags">
        @foreach($categories as $category)
            <a href="{{ route('products', ['id'=> $category['id'], 'data_from'=>'category', 'page'=>1]) }}"
               class="amazon-category-tag">
                @if($category['icon'])
                    <img src="{{ getStorageImages(path: $category['icon_full_url'], type:'category') }}"
                         alt="{{ $category['name'] }}" loading="lazy" class="category-tag-icon">
                @endif
                <span>{{ $category['name'] }}</span>
            </a>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const horizontalBar = document.getElementById('horizontal-categories-bar');
    if (!horizontalBar) return;
    
    let lastScrollY = window.pageYOffset;
    let isHidden = false;
    let ticking = false;
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                const currentScrollY = window.pageYOffset;
                
                // Hide when scrolling down, show when scrolling up
                if (currentScrollY > lastScrollY && currentScrollY > 150) {
                    // Scrolling down
                    if (!isHidden) {
                        horizontalBar.style.transform = 'translateY(-100%)';
                        horizontalBar.classList.add('hidden');
                        isHidden = true;
                    }
                } else if (currentScrollY < lastScrollY) {
                    // Scrolling up
                    if (isHidden) {
                        horizontalBar.style.transform = 'translateY(0)';
                        horizontalBar.classList.remove('hidden');
                        isHidden = false;
                    }
                }
                
                lastScrollY = currentScrollY;
                ticking = false;
            });
            ticking = true;
        }
    });
});
</script>
