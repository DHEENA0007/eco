<!-- Horizontal Categories Tags -->
@php
    use App\Utils\Helpers;
@endphp
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
