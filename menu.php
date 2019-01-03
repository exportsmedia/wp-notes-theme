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
                <a href="<?php echo home_url(); ?>" class="text-white h2" style="text-decoration: none;vertical-align: middle;">
                    <span class="font-weight-bold">Michael's</span><span class="font-weight-light">Minutes</span>
                </a>
                <span class="description h6 text-light ml-4"><?php echo get_bloginfo('description');?></span>
            </div>
        </div> 
        
        <div class="col-6">

            <!--  the Menu -->
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_id' => 'main-menu', ) ); ?>

        </div>

    </div>
</header> <!--  End blog header -->
   