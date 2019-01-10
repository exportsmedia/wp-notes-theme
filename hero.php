<?php 
/**
 * @package WordPress
 * @subpackage WP-Mike-Notes
 */
global $post;
?>

<?php if(is_single()) {

    $count = (int) get_post_meta($post->ID, 'view_count', true);
    
    update_post_meta($post->ID, 'view_count', ($count + 1));
    
    ?>

    <?php $hero_id = get_post_meta( $post->ID, '_hero_image_id', true); ?>

    <?php $hero_img_url = wp_get_attachment_url($hero_id); ?>

    <?php if($hero_img_url) { ?>

        <div class="hero bg-image" style="background-image: url(<?php echo $hero_img_url; ?>);"></div>

    <?php } ?>

<?php } ?>