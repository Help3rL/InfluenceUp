<?php /* Template Name: Home page template */ ?>
<?php
get_header();
?>
<svg id="animated-lines"></svg>
<main id="primary" class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        <?php //Hero section
        $hero = get_field('hero_section');
        if ($hero) : ?>
            <div id="hero">
                <div class="hero-title-container">
                    <h1><?php echo esc_html($hero['hero_title1']); ?><br><span><?php echo esc_html($hero['hero_title2']); ?></span></h1>
                </div>
                <div class="step-carousel-container">
                    <div class="steps-carousel">
                        <?php foreach ($hero['step_carousel'] as $step) : ?>
                            <div class="step-item">
                                <div class="step-number"><?php echo esc_html($step['number']); ?></div>
                                <h3><?php echo esc_html($step['title']); ?></h3>
                                <p><?php echo esc_html($step['description']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!-- Rtcl listings -->
        <div class="services-carousel-container">
            <div class="services-headings-container">
                <h3><?php echo esc_html(get_field('rtcl_listings_carousel_title')); ?></h3>
                <div>
                    <button type="button" class="service-carousel-prev">
                        <?php echo file_get_contents(get_stylesheet_directory() . '/inc/img/arrow/arrow-left-light.svg'); ?>
                    </button>
                    <button type="button" class="service-carousel-next">
                        <?php echo file_get_contents(get_stylesheet_directory() . '/inc/img/arrow/arrow-right-light.svg'); ?>
                    </button>
                </div>
            </div>
            <div class="services-carousel-cards">
                <?php
                $listings = new WP_Query(array(
                    'post_type' => 'rtcl_listing',
                    'posts_per_page' => -1,
                ));
                if ($listings->have_posts()) : ?>
                    <?php while ($listings->have_posts()) : $listings->the_post(); ?>
                        <a href="<?php the_permalink(); ?>">
                            <div class="service-card">
                                <?php
                                $image_url = get_listing_image_url(get_the_ID());
                                if (!empty($image_url)) : ?>
                                    <img class="service-img" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                                <div class="service-content-container">
                                    <div class="first-block">
                                        <h3 class="service-name"><?php the_title(); ?></h3>
                                        <p class="service-category">Category</p> <!-- Čia galite pakeisti į dinamiškai gautą kategoriją -->
                                    </div>
                                    <div class="second-block">
                                        <p class="service-rating">4.5</p> <!-- Šie duomenys turėtų būti dinamiškai generuojami -->
                                        <p class="service-price">100 EUR</p> <!-- Šie duomenys turėtų būti dinamiškai generuojami -->
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>No listings found.</p>
                <?php endif;
                wp_reset_postdata(); ?>
            </div>
        </div>

        <?php //First section text with button
        $textWithButton = get_field('text_group_with_button1');
        if ($textWithButton) : ?>
            <div class="text-with-button-parent">
                <div class="text-with-button-cointainer">
                    <div class="text-with-button">
                        <h3><?php echo esc_html($textWithButton['title']) ?></h3>
                        <?php if (isset($textWithButton['button_field'])) : ?>
                            <?php $button = $textWithButton['button_field']; ?>
                            <a class="yellow-buttom" href="<?php echo esc_url($button['url']); ?>">
                                <?php echo esc_html($button['button_text']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <img src="<?php echo get_template_directory_uri(); ?>/inc/img/content-logo.svg" />
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Rtcl categories -->
        <div class="rtcl-categories-container">
            <div class="carousel-headings-container">
                <h3><?php echo esc_html(get_field('rtcl_categories_carousel_title')); ?></h3>
                <div>
                    <button type="button" class="carousel-prev">
                        <?php echo file_get_contents(get_stylesheet_directory() . '/inc/img/arrow/arrow-left.svg'); ?>
                    </button>
                    <button type="button" class="carousel-next">
                        <?php echo file_get_contents(get_stylesheet_directory() . '/inc/img/arrow/arrow-right.svg'); ?>
                    </button>
                </div>
            </div>
            <div class="carousel-cards">
                <?php
                $categories = get_categories(array(
                    'taxonomy' => 'rtcl_category',
                    'hide_empty' => false,
                ));
                if (!empty($categories)) : ?>
                    <?php foreach ($categories as $category) : ?>
                        <?php
                        if ($category->name == 'All categories' || $category->name == 'visos kategorijos') {
                            continue;
                        }
                        $category_link = get_term_link($category);
                        $category_image_id = get_term_meta($category->term_id, '_rtcl_image', true);
                        $category_image_url = wp_get_attachment_url($category_image_id);
                        ?>
                        <a href="<?php echo esc_url($category_link); ?>">
                            <div class="category-card">
                                <?php if ($category_image_url) : ?>
                                    <img class="category-img" src="<?php echo esc_url($category_image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
                                <?php endif; ?>
                                <h3 class="carousel-category-name"><?php echo esc_html($category->name); ?></h3>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Nėra kategorijų.</p>
                <?php endif; ?>
            </div>
        </div>

        <?php //About us section
        $aboutUs = get_field('about_us_section');
        if ($aboutUs) : ?>
            <div class="about-us-section">
                <div class="about-us-container">
                    <div class="about-us-text">
                        <h3><?php echo esc_html($aboutUs['title']) ?></h3>
                        <?php echo wp_kses_post($aboutUs['description']); ?>
                    </div>
                    <?php if (isset($aboutUs['images']) && is_array($aboutUs['images'])) : ?>
                        <div class="about-us-gallery">
                            <?php foreach ($aboutUs['images'] as $index => $image) : ?>
                                <?php if ($index % 2 == 0) : ?>
                                    <!-- Started new div for two images -->
                                    <div class="image-row">
                                    <?php endif; ?>
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    <?php if ($index % 2 == 1 || $index === count($aboutUs['images']) - 1) : ?>
                                        <!-- Close div if second image is last -->
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php endif; ?>

        <?php //Brands section
        $brands = get_field('brands_section');
        if ($brands) : ?>
            <div class="brands-parent">
                <div class="brands-container">
                    <div class="brands-heading">
                        <h3><?php echo esc_html($brands['title']) ?></h3>
                    </div>
                    <?php if (isset($brands['brands_images']) && is_array($brands['brands_images'])) : ?>
                        <div class="brands">
                            <?php foreach ($brands['brands_images'] as $index => $image) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php endif; ?>

        <?php //Second text with button
        $textWithButton1 = get_field('text_group_with_button2');
        if ($textWithButton1) : ?>
            <div class="text-with-button-parent">
                <div class="text-with-button-cointainer">
                    <div class="text-with-button">
                        <h3><?php echo esc_html($textWithButton1['title']) ?></h3>
                        <?php if (isset($textWithButton1['button_field'])) : ?>
                            <?php $button = $textWithButton1['button_field']; ?>
                            <a class="yellow-buttom" href="<?php echo esc_url($button['url']); ?>">
                                <?php echo esc_html($button['button_text']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <img src="<?php echo get_template_directory_uri(); ?>/inc/img/content-logo.svg" />
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php //Advantages
        $advantages = get_field('advantages_section');
        if ($advantages) : ?>
            <div class="advantages-container">
                <div class="advantages-heading-container">
                    <h3><?php echo esc_html(get_field('advantages_title')); ?></h3>
                </div>
                <div class="items-container">
                    <?php foreach ($advantages as $advantage) : ?>
                        <div class="advantage-item">
                            <h3><?php echo esc_html($advantage['title']); ?></h3>
                            <p><?php echo esc_html($advantage['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endwhile; // end of the loop. 
    ?>

</main><!-- #main -->

<?php
get_footer();
