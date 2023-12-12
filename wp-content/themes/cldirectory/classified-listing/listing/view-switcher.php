<?php
/**
 * View switcher
 *
 * @version     1.5.5
 *
 * @var array  $views
 * @var string $current_view
 * @var string $default_view
 */

if (!defined('ABSPATH')) {
    exit;
}
if (empty($views)) {
    return;
}
?>
<div class="rtcl-view-switcher">
    <?php
    foreach ($views as $value => $label) {
        $active = $current_view === $value ? ' active' : '';
        $thIcon = $value === 'grid' ? "grid-cl" : 'list-cl';
        ?>
        <a class="rtcl-view-trigger<?php echo esc_attr($active); ?> <?php echo esc_attr($thIcon); ?>" data-type="<?php echo esc_attr($value); ?>"
           href="<?php echo add_query_arg('view', $value) ?>"><i
                    class="<?php echo esc_attr($thIcon); ?>-icon"> </i></a>
    <?php } ?>
</div>
