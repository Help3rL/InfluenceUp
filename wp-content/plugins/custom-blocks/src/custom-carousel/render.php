<?php
// Užtikrina, kad failas būtų vykdomas tik per WordPress aplinką.
if (!defined('ABSPATH')) {
    exit;
}
echo 'Labas';

// custom-blocks/blocks/custom-carousel/render.php
function render_custom_carousel_block($attributes) {
    // čia generuokite HTML iš $attributes
    // Pavyzdžiui, galite iteruoti per kategorijas ir atvaizduoti jas.
    $html = '<div class="custom-carousel-wrapper">';

    foreach ($attributes['categories'] as $category) {
        $html .= '<div class="custom-carousel-category">';
        $html .= '<img src="' . esc_url($category['image']) . '" alt="' . esc_attr($category['name']) . '">';
        $html .= '<h2 class="carousel-category-name">' . esc_html($category['name']) . '</h2>';
        $html .= '</div>';
    }

    $html .= '</div>';

    return $html;
}

