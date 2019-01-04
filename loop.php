<?php 
/**
 * @package WordPress
 * @subpackage WP-Mike-Notes
 */
?>

  <div class="content">
    <div class="container mt-5 mb-5"> 
                        
        <?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
                        
          <article id="post-<?php the_ID(); ?>">
            <div class="title">            
              <?php the_title('<h1 class="font-weight-bold">', '</h1>'); ?>  <!--Post titles-->
            </div>

            <!--The Meta, Author, Date, Categories and Comments-->   
              <small class="meta"> 
                <span  class="font-weight-bold">By <?php the_author(); ?></span>
                  | 
                <span  class="font-weight-light"><?php echo get_the_date(); ?></span>
              </small>

              <hr style="">
              
              <?php the_content(); ?> <!--The Content-->
      
          </article>

          <?php $categories = get_the_category(); ?>

          <?php foreach($categories as $category) {

            $cat_link = get_category_link($category->cat_ID);
            echo '<a href="/?search='.$category->name.'" class="category-link">'.$category->name.'</a>';
          
          } ?>
                        
        <?php endwhile; ?><!--  End the Loop -->

    </div>
  
    <?php /* Only load comments on single post/pages*/ ?>
    <?php if(is_page() || is_single()) : comments_template( '', true ); endif; ?>
     
  </div><!-- End Content -->
    
