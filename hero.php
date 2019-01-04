<?php 
/**
 * @package WordPress
 * @subpackage WP-Mike-Notes
 */
global $post;
?>

<?php if(is_single()) { ?>

    <?php $featured_img_url = get_the_post_thumbnail_url($post->ID,'hero'); ?>

    <?php if($featured_img_url) { ?>

        <div class="hero bg-image" style="background-image: url(<?php echo $featured_img_url; ?>);"></div>

    <?php } ?>

<?php } ?>