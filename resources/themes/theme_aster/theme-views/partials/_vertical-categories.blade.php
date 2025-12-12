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
        flex-wrap: nowrap;
        gap: 8px;
        align-items: center;
        padding: 0 15px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .amazon-category-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: var(--bs-secondary-bg, #f0f2f5);
        border-radius: 20px;
        text-decoration: none;
        color: var(--bs-body-color, #333);
        font-size: 14px;
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
        width: 20px;
        height: 20px;
        object-fit: cover;
        border-radius: 50%;
        flex-shrink: 0;
        background: var(--bs-body-bg, #fff);
    }

    /* Dark Theme Specific Styles */
    [data-bs-theme="dark"] .amazon-horizontal-categories,
    .dark-theme .amazon-horizontal-categories {
        background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%);
        border-bottom-color: #404040;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    }

    [data-bs-theme="dark"] .amazon-category-tag,
    .dark-theme .amazon-category-tag {
        background: linear-gradient(135deg, #2d2d2d 0%, #1f1f1f 100%);
        color: #e0e0e0;
        border: 1px solid #404040;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    [data-bs-theme="dark"] .amazon-category-tag:hover,
    .dark-theme .amazon-category-tag:hover {
        background: linear-gradient(135deg, #404040 0%, #2d2d2d 100%);
        color: #ffffff;
        border-color: #606060;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6), 0 0 8px rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    [data-bs-theme="dark"] .category-tag-icon,
    .dark-theme .category-tag-icon {
        background: #1f1f1f;
        border: 1px solid #404040;
        box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.1);
    }
</style>

<div class="amazon-horizontal-categories" id="horizontal-categories-bar">
    <div class="amazon-categories-tags">
        @foreach($categories as $category)
            <a href="{{ route('products', ['id'=> $category['id'], 'data_from'=>'category', 'page'=>1]) }}"
               class="amazon-category-tag">
                @if($category['icon'])
                    <img src="{{ getStorageImages(path: $category['icon_full_url'], type:'category') }}"
                         alt="{{ $category['name'] }}" loading="lazy" class="category-tag-icon dark-support">
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
