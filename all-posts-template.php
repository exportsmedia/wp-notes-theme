<?php
/**
 * Template Name: All Posts
 *
 * @package WordPress
 * @subpackage WP-Mike-Notes
 */
get_header();

global $post;

$featured_img_url = get_the_post_thumbnail_url($post->ID,'full');

if($featured_img_url) { ?>

    <div class="hero bg-image" style="background-image: url(<?php echo $featured_img_url; ?>);"></div>

<?php }

wp_reset_postdata();

$year = (isset($_GET['show-year'])) ? $_GET['show-year'] : '';

if($year) {

    $args = array(
        'post_type'   => 'post',
        'posts_per_page' => -1,
        'ignore_sticky_posts' => true,
        'date_query' => array(
            array(
                'year' => $year
            ),
        ),
    );

} else {

    $args = array(
        'post_type'   => 'post',
        'posts_per_page' => -1,
        'ignore_sticky_posts' => true
    );

}



// the query
$the_query = new WP_Query( $args );

?>

	<section id="primary" class="content-area container post-archive mt-5">
		<div id="content" class="site-content" role="main">

			<?php if ( $the_query->have_posts() ) : ?>

            <div class="row">
            
                <div class="col-md-2">

                    <header class="archive-header">

                        <div class="title archive-title">            
                            <h1 class="font-weight-bold">Year</h1>
                        </div> 

                        <hr style="">

                        <?php

                        $firstYear = 2018;
                        $thisYear = date('Y');
                        for($i=$thisYear;$i>=$firstYear;$i--) {
                            echo '<a class="d-block h3" href="' . get_the_permalink($post->ID) . '?show-year=' . $i . '">' . $i . '</a>';
                        }
                        ?>

                    </header>
                
                
                </div>

                <div class="col-md-10">

                    <div class="d-flex flex-wrap recents mb-3 justify-content-center justify-content-md-start">

                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                            <div class="recent-item">

                                <figure class="item-image">
                                    <a href="<?php echo get_the_permalink($the_query->post->ID); ?>">
                                        <?php $featured_img_url = get_the_post_thumbnail_url($the_query->post->ID,'full'); ?>
                                        <?php if($featured_img_url) { ?>
                                            <img src="<?php echo $featured_img_url; ?>" alt="<?php echo get_the_title($the_query->post->ID); ?>" />
                                        <?php } ?>
                                        <figcaption>
                                            <h3><?php echo get_time_ago(strtotime(get_the_date())); ?></h3>
                                            <p class="read-more">Read More</p>
                                        </figcaption>
                                    </a>
                                </figure>

                                <div class="item-meta">
                                    <p class="font-weight-bold h6"><?php the_title(); ?></p>
                                    <p class="h6"><?php echo get_post_meta($the_query->post->ID, 'post_byline', true); ?></p>
                                </div>

                            </div>

                        <?php
                        endwhile;
                        wp_reset_postdata();
                        else :
                            echo '<h2>No posts found.</h2>';
                        endif;
                        ?>
                    </div>
                
                </div>
            
            </div>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_footer();