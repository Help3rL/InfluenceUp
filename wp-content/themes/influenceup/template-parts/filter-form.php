<form id="custom-filter-form" action="" method="POST">
    <!-- Category filter -->
    <div class="filter-section">
        <h3><?php _e('Categories', 'text-domain'); ?></h3>
        <?php
        $categories = get_terms(array('taxonomy' => 'rtcl_category', 'hide_empty' => false));
        $parent_category = array();
        $child_categories = array();

        if (!is_wp_error($categories) && !empty($categories)) {
            foreach ($categories as $category) {
                if ($category->parent == 0) {
                    $parent_category[] = $category;
                } else {
                    $child_categories[$category->parent][] = $category;
                }
            }

            foreach ($parent_category as $parent) {
                $total_count = $parent->count;
                if (isset($child_categories[$parent->term_id])) {
                    foreach ($child_categories[$parent->term_id] as $child) {
                        $total_count += $child->count;
                    }
                }
                echo '<label>';
                echo '<input type="radio" name="category" value="' . esc_attr($parent->slug) . '">';
                echo esc_html($parent->name) . ' (' . esc_html($total_count) . ')';
                echo '</label>';

                if (isset($child_categories[$parent->term_id])) {
                    foreach ($child_categories[$parent->term_id] as $child) {
                        echo '<label style="margin-left: 15px;">';
                        echo '<input type="radio" name="category" value="' . esc_attr($child->slug) . '">';
                        echo esc_html($child->name) . ' (' . esc_html($child->count) . ')';
                        echo '</label>';
                    }
                }
            }
        }
        ?>
    </div>

    <!-- Revies count filter -->
    <div class="filter-section">
        <h3><?php _e('Number of reviews', 'text-domain'); ?></h3>
        <?php
        $review_counts = [
            '100' => '100+ reviews',
            '50' => '50+ reviews',
            '10' => '10+ reviews'
        ];
        foreach ($review_counts as $value => $label) {
            $args = array(
                'post_type' => 'rtcl_listing',
                'post_status' => 'publish',
                'meta_query' => array(),
                'tax_query' => array(),
                'fields' => 'ids',
            );

            $comment_post_ids = get_comment_post_ids_by_min_reviews($value);
            if (!empty($comment_post_ids)) {
                $args['post__in'] = $comment_post_ids;
            } else {
                $args['post__in'] = array(0); // No posts found
            }

            $review_count = new WP_Query($args);

            echo '<label>';
            echo '<input type="radio" name="reviews" value="' . esc_attr($value) . '">';
            echo esc_html($label) . ' (' . $review_count->found_posts . ')';
            echo '</label>';
        }
        ?>
    </div>

    <!-- Price filter -->
    <div class="filter-section">
        <h3><?php _e('Price', 'text-domain'); ?></h3>
        <?php
        $price_ranges = [
            '0,25' => '€0 - €25',
            '25,50' => '€25 - €50',
            '50,100' => '€50 - €100',
            '100,' => '€100+'
        ];
        foreach ($price_ranges as $value => $label) {
            $price = explode(',', $value);
            $meta_query = array();
            if (count($price) == 2) {
                $meta_query[] = array(
                    'key' => 'price',
                    'value' => array_map('intval', $price),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN'
                );
            } else {
                $meta_query[] = array(
                    'key' => 'price',
                    'value' => (int) $price[0],
                    'type' => 'NUMERIC',
                    'compare' => '>='
                );
            }

            $price_count = new WP_Query(array(
                'post_type' => 'rtcl_listing',
                'post_status' => 'publish',
                'meta_query' => $meta_query
            ));
            echo '<label>';
            echo '<input type="radio" name="price" value="' . esc_attr($value) . '">';
            echo esc_html($label) . ' (' . $price_count->found_posts . ')';
            echo '</label>';
        }
        ?>
    </div>

    <!-- Custom price filter -->
    <div class="filter-section">
        <h3><?php _e('Custom Price', 'text-domain'); ?></h3>
        <input type="number" name="min_price" placeholder="<?php _e('Min Price', 'text-domain'); ?>">
        <input type="number" name="max_price" placeholder="<?php _e('Max Price', 'text-domain'); ?>">
    </div>

    <button type="submit"><?php _e('Filter', 'text-domain'); ?></button>
    <button type="reset" id="reset-filter"><?php _e('Reset', 'text-domain'); ?></button>
</form>

<div id="custom-filter-results"></div>