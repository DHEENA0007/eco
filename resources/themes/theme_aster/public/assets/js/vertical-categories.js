/**
 * Vertical Categories Toggle Script
 */

$(document).ready(function() {
    // Toggle category children on click
    $('.vertical-category-list .category-item.has-children > a').on('click', function(e) {
        e.preventDefault();

        var $parent = $(this).closest('.category-item');
        var $subcategories = $parent.find('> .subcategory-list');

        // Toggle active class
        $parent.toggleClass('active');

        // Slide toggle subcategories
        $subcategories.slideToggle(300);
    });

    // Toggle subcategory children on click
    $('.vertical-category-list .subcategory-item.has-children > a').on('click', function(e) {
        e.preventDefault();

        var $parent = $(this).closest('.subcategory-item');
        var $subSubcategories = $parent.find('> .sub-subcategory-list');

        // Toggle active class
        $parent.toggleClass('active');

        // Slide toggle sub-subcategories
        $subSubcategories.slideToggle(300);
    });

    // Allow clicking on category links without children
    $('.vertical-category-list .category-item:not(.has-children) > a, .vertical-category-list .subcategory-item:not(.has-children) > a').on('click', function(e) {
        // Let the link work normally
        return true;
    });
});
