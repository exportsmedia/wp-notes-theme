<?php 
/**
 * @package WordPress
 * @subpackage WP-Mike-Notes
 */

global $post;
?>
  <header class="site-header" itemscope="" itemtype="https://schema.org/WPHeader">  

    <div class="row">
    
        <div class="col-12"> 
            <div class="logo">
                <a href="<?php echo home_url(); ?>" class="h2 mr-5" style="margin:0; text-decoration: none;">
                    <span class="font-weight-bold">Michael's</span><span class="font-weight-light">Minutes</span>
                </a>
                <span class="description h6 pr-5 d-block d-sm-inline-block" style="vertical-align: middle;"><?php echo get_bloginfo('description');?></span>
                <?php if(isset($post)) { ?>
                    <span class="page-title h6 pr-5 d-block d-sm-inline-block" style="vertical-align: middle;"><?php echo $post->post_title;?></span>
                <?php } ?>
            </div>

            <!--  the Menu -->
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_id' => 'main-menu', 'container_class' => 'float-right' ) ); ?>

        </div>

    </div>

    <?php if(is_single()) { ?>

        <progress value="0" max="1">
            <!-- Older browsers look to the old div style of progress bars -->
            <!-- Newer browsers ignore this stuff but it allows older browsers to 
                    still have a progress bar. -->
            <div class="progress-container">
                <span class="progress-bar"></span>    
            </div>
        </progress>

    <?php } ?>

</header> <!--  End blog header -->
   