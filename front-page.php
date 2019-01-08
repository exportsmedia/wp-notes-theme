<?php
/**
 * @package WordPress
 * @subpackage WP-Mike-Notes
 */
 
    get_header();  //the Header  
    
    //get_template_part( 'loop', 'index' ); //the Loop 

    $args = array(
        'numberposts' => 5,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
    );

    $recent_posts = get_posts( $args );

    $featured_img_url = get_the_post_thumbnail_url($recent_posts{0}->ID,'hero');

    if($featured_img_url) { ?>

        <div class="hero bg-image" style="background-image: url(<?php echo $featured_img_url; ?>);"></div>

    <?php }

    $count = 1;

    //$posts = array_shift($recent_posts);
    unset($recent_posts[0]);
    // echo '<pre>';
    // print_r($recent_posts);
    // echo '</pre>';

    ?>

    <div class="container mt-5 mb-5">

        <span class="text-light bg-dark px-2 py-1 mr-3">Recent Posts</span>

        <a href="/all/" class="font-italic">See All</a>

        <div class="d-flex recents">

            <?php foreach( $recent_posts as $recent ) { setup_postdata( $recent ); ?>

                <div class="recent-item">

                    <figure class="item-image">
                        <a href="<?php echo get_the_permalink($recent->ID); ?>">
                            <img src="https://source.unsplash.com/random/320x320" alt="sample82" />
                            <figcaption>
                                <h3><?php echo get_time_ago(strtotime($recent->post_date)); ?></h3>
                                <p class="read-more">Read More</p>
                            </figcaption>
                        </a>
                    </figure>

                    <div class="item-meta">
                        <p class="font-weight-bold h6"><?php echo $recent->post_title; ?></p>
                        <p class="h6"><?php echo $recent->post_excerpt; ?></p>
                    </div>

                </div>

            <?php } ?>

            </div>
        
        </div>

    <?php

	wp_reset_query();
                    
    get_footer(); //the Footer 
   