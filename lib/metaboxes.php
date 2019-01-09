<?php
/**
 * Metabox Code
 *
 * @package WordPress
 * @subpackage WP-Mike-Notes
 */



function add_post_byline_meta_box() {
	add_meta_box(
		'post_byline_meta_box', // $id
		'Byline', // $title
		'show_post_byline_meta_box', // $callback
		'post', // $screen
		'side', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_post_byline_meta_box' );


function show_post_byline_meta_box() {
    wp_nonce_field( basename( __FILE__ ), 'byline_meta_box_nonce' );
	global $post;  
	$post_byline = get_post_meta( $post->ID, 'post_byline', true ); ?>

    <p>
        <input type="text" class="byline" name="byline_meta[post_byline]" id="byline_meta[post_byline]" style="width: 100%;" value="<?php echo $post_byline; ?>">
        <span class="remaining-chars">0</span> characters left.
    </p>

    <script>
        $('.byline').keypress(function(e) {
        var tval = $('.byline').val(),
            tlength = tval.length,
            set = 80,
            remain = parseInt(set - tlength);
        $('.remaining-chars').text(remain);
        if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
            $('.byline').val((tval).substring(0, tlength - 1))
        }
    })
    </script>

    <?php 

}


function save_post_byline_meta( $post_id, $post ) {   
	/* Verify the nonce before proceeding. */
    if ( !isset( $_POST['byline_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['byline_meta_box_nonce'], basename( __FILE__ ) ) )
        return $post_id;
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	/* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;
	
    if(!empty($_POST['byline_meta'])){

		foreach($_POST['byline_meta'] as $key => $value){

			/* Get the posted data and sanitize it for use as an HTML class. */
			$new_meta_value = ( isset( $value ) ? sanitize_text_field( $value ) : '' );

			if ( $new_meta_value != '' ) {

				update_post_meta( $post_id, $key, $new_meta_value );

			} else {

				delete_post_meta( $post_id, $key );

			}

		}

    }
      
}
add_action( 'save_post', 'save_post_byline_meta', 10, 2 );