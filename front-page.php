<?php
/**
 * @package WordPress
 * @subpackage WP-Mike-Notes
 */
 
get_header();  //the Header  

// get recent posts
$args = array(
    'numberposts' => 4,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish'
);

$recent_posts = get_posts( $args );

$hero_id = get_post_meta( $recent_posts{0}->ID, '_hero_image_id', true);

$hero_img_url = wp_get_attachment_url($hero_id);

if($hero_img_url) { ?>

    <div class="hero bg-image" style="background-image: url(<?php echo $hero_img_url; ?>);">
        <a href="<?php echo get_the_permalink($recent_posts{0}->ID); ?>" title="Read <?php echo get_the_title($recent_posts{0}->ID); ?>" style="position: absolute;top:0;bottom:0;left:0;right:0;"></a>
    </div>

<?php }

wp_reset_query();

// get popular posts
$args = array(
    'post_type'   => 'post',
    'posts_per_page' => 4,
    'ignore_sticky_posts' => true,
    'orderby'   => 'meta_value_num',
    'meta_key'  => 'view_count',
    'order'     => 'DESC',
    'date_query' => array(
        array(
            'after' => '-60 days',
            'column' => 'post_date',
        ),
    ),
);

$popular_query = new WP_Query( $args );

wp_reset_query();

// get featured categories posts
$featured_category = get_theme_mod('featured_category');

// if none set, get random category
if(!$featured_category) {
    $categories = get_categories();
    shuffle( $categories );
    $random_category = array_slice( $categories, 0, 1 );
    $featured_category = $random_category{0}->term_id;
}

$args = array(
    'numberposts' => 4,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'category' => $featured_category,
    'post_status' => 'publish'
);

$featured_category_posts = get_posts( $args );

wp_reset_query();

?>

<div id="primary" class="container mt-5 mb-5">

    <section class="recent-posts mb-5">
    
        <span class="text-light bg-dark px-2 py-1 mr-3">Recent Posts</span>

        <a href="/all/" class="font-italic">See All</a>

        <div class="d-flex flex-wrap recents mb-3 justify-content-center justify-content-md-start">

            <?php foreach( $recent_posts as $post ) { setup_postdata( $post ); ?>

                <div class="recent-item">

                    <figure class="item-image">
                        <a href="<?php echo get_the_permalink($post->ID); ?>">
                            <?php $featured_img_url = get_the_post_thumbnail_url($post->ID,'full'); ?>
                            <?php if($featured_img_url) { ?>
                                <img src="<?php echo $featured_img_url; ?>" alt="<?php echo get_the_title($post->ID); ?>" />
                            <?php } ?>
                            <figcaption>
                                <h3><?php echo get_time_ago(strtotime($post->post_date)); ?></h3>
                                <p class="read-more">Read More</p>
                            </figcaption>
                        </a>
                    </figure>

                    <div class="item-meta">
                        <p class="font-weight-bold h6"><?php echo $post->post_title; ?></p>
                        <p class="h6"><?php echo get_post_meta($post->ID, 'post_byline', true); ?></p>
                    </div>

                </div>

            <?php } ?>
        
        </div>
    
    </section>

    <section class="popular-category mt-5">
    
        <span class="text-light bg-dark px-2 py-1 mr-3">Popular Posts</span>

        <div class="d-flex flex-wrap recents mb-3 justify-content-center justify-content-md-start">

            <?php foreach( $popular_query->posts as $post ) { setup_postdata( $post ); ?>

                <div class="recent-item">

                    <figure class="item-image">
                        <a href="<?php echo get_the_permalink($post->ID); ?>">
                            <?php $featured_img_url = get_the_post_thumbnail_url($post->ID,'full'); ?>
                            <?php if($featured_img_url) { ?>
                                <img src="<?php echo $featured_img_url; ?>" alt="<?php echo get_the_title($post->ID); ?>" />
                            <?php } ?>
                            <figcaption>
                                <h3><?php echo get_time_ago(strtotime($post->post_date)); ?></h3>
                                <p class="read-more">Read More</p>
                            </figcaption>
                        </a>
                    </figure>

                    <div class="item-meta">
                        <p class="font-weight-bold h6"><?php echo $post->post_title; ?></p>
                        <p class="h6"><?php echo get_post_meta($post->ID, 'post_byline', true); ?></p>
                    </div>

                </div>

            <?php } ?>

        </div>
    
    </section>

    <section class="featured-category mt-5">
    
        <span class="text-light bg-dark px-2 py-1 mr-3"><?php echo get_cat_name($featured_category);?></span>

        <a href="<?php echo get_category_link( $featured_category ); ?>" class="font-italic">See All</a>

        <div class="d-flex flex-wrap recents mb-3 justify-content-center justify-content-md-start">

            <?php foreach( $featured_category_posts as $post ) { setup_postdata( $post ); ?>

                <div class="recent-item">

                    <figure class="item-image">
                        <a href="<?php echo get_the_permalink($post->ID); ?>">
                            <?php $featured_img_url = get_the_post_thumbnail_url($post->ID,'full'); ?>
                            <?php if($featured_img_url) { ?>
                                <img src="<?php echo $featured_img_url; ?>" alt="<?php echo get_the_title($post->ID); ?>" />
                            <?php } ?>
                            <figcaption>
                                <h3><?php echo get_time_ago(strtotime($post->post_date)); ?></h3>
                                <p class="read-more">Read More</p>
                            </figcaption>
                        </a>
                    </figure>

                    <div class="item-meta">
                        <p class="font-weight-bold h6"><?php echo $post->post_title; ?></p>
                        <p class="h6"><?php echo get_post_meta($post->ID, 'post_byline', true); ?></p>
                    </div>

                </div>

            <?php } ?>

        </div>
    
    </section>

</div>

<?php

wp_reset_query();
                
get_footer(); //the Footer 
