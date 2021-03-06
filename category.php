<?php
/**
 * The template for displaying Category pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage WP-Mike-Notes
 */
get_header(); ?>

	<section id="primary" class="content-area container category-archive">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="archive-header mt-5">

                <div class="title archive-title">            
                    <h1 class="font-weight-bold"><?php printf( __( '%s', 'wp-mike-notes' ), single_cat_title( '', false ) ); ?></h1>
                </div> 
                <div class="meta"> 
                    <span  class="font-weight-light"><?php
					    // Show an optional term description.
                        $term_description = term_description();
                        if ( ! empty( $term_description ) ) :
                            printf( '<div class="taxonomy-description">%s</div>', $term_description );
                            endif;
                        ?>
                    </span>
                </div>

                <hr style="">

            </header><!-- .archive-header -->
            
            <div class="d-flex flex-wrap recents mb-3 justify-content-center">

				<?php
					// Start the Loop.
				while ( have_posts() ) :
                    the_post();
                    
                    ?>

                        <div class="recent-item">

                            <figure class="item-image">
                                <a href="<?php echo get_the_permalink(get_the_ID()); ?>">
                                    <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
                                    <?php if($featured_img_url) { ?>
                                        <img src="<?php echo $featured_img_url; ?>" alt="<?php echo get_the_title(get_the_ID()); ?>" />
                                    <?php } ?>
                                    <figcaption>
                                        <h3><?php echo get_time_ago(strtotime(get_the_date())); ?></h3>
                                        <p class="read-more">Read More</p>
                                    </figcaption>
                                </a>
                            </figure>

                            <div class="item-meta">
                                <p class="font-weight-bold h6"><?php the_title(); ?></p>
                                <p class="h6"><?php echo get_post_meta(get_the_ID(), 'post_byline', true); ?></p>
                            </div>

                        </div>

                    <?php
					endwhile;
				else :
					// If no content, include the "No posts found" template.
					echo '<h2>No posts founds.</h2>';
				endif;
                ?>
            </div>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_footer();