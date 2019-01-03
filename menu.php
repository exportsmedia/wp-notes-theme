<?php 
/**
 * @package WordPress
 * @subpackage WP-Mike-Notes
 */
?>
  <header class="site-header" itemscope="" itemtype="https://schema.org/WPHeader">  

    <div class="row">
    
        <div class="col-6"> 
            <div class="logo">
                <a href="<?php echo home_url(); //make logo a home link?>">
                    <span><?php echo get_bloginfo('name');?></span>
                </a>
                <span class="description"><?php echo get_bloginfo('description');?></span>
            </div>
        </div> 
        
        <div class="col-6">

            <!--  the Menu -->
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

        </div>

    </div>
</header> <!--  End blog header -->
   