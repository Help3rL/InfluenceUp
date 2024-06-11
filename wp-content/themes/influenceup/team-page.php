<?php /* Template Name: Team page template */ ?>
<?php
get_header();
?>
<svg id="animated-lines"></svg>
<main id="primary" class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        <div id="teamParent">
            <div class="team-heading">
                <h1><?php echo esc_html(get_field('title')); ?></h1>
                <?php echo wp_kses_post(get_field('paragraph')); ?>
            </div>
            <div class="team-parent-container">
                <?php if (have_rows('team_people')) : ?>
                    <?php while (have_rows('team_people')) : the_row(); ?>
                        <div class="team-member">
                            <?php
                            $image = get_sub_field('team_member_image');
                            if (isset($image) && is_array($image)) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endif; ?>
                            <div class="team-member-content">
                                <h3><?php echo esc_html(get_sub_field('team_member_name')); ?></h3>
                                <p><?php echo esc_html(get_sub_field('position')); ?></p>
                                <div class="social-links">
                                    <?php if (have_rows('social_links')) : ?>
                                        <?php while (have_rows('social_links')) : the_row(); ?>
                                            <?php
                                            $facebook_url = get_sub_field('facebook_url');
                                            $twitter_url = get_sub_field('twitter_url');
                                            $instagram_url = get_sub_field('instagram_url');
                                            ?>
                                            <?php if (!empty($facebook_url)) : ?>
                                                <a href="<?php echo esc_url($facebook_url); ?>" target="_blank">
                                                    <img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/facebook-icon.svg" alt="facebook-icon">
                                                </a>
                                            <?php endif; ?>
                                            <?php if (!empty($twitter_url)) : ?>
                                                <a href="<?php echo esc_url($twitter_url); ?>" target="_blank">
                                                    <img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/x-icon.svg" alt="x-icon">
                                                </a>
                                            <?php endif; ?>
                                            <?php if (!empty($instagram_url)) : ?>
                                                <a href="<?php echo esc_url($instagram_url); ?>" target="_blank">
                                                    <img src="<?php echo get_template_directory_uri(); ?>/inc/img/icons/instagram-icon.svg" alt="instagram-icon">
                                                </a>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; // end of the loop. 
    ?>

</main><!-- #main -->

<?php
get_footer();
