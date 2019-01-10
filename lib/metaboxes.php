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




add_action( 'add_meta_boxes', 'hero_image_add_metabox' );
function hero_image_add_metabox () {
	add_meta_box( 'heroimagediv', __( 'Hero Image', 'text-domain' ), 'hero_image_metabox', 'post', 'side', 'low');
}
function hero_image_metabox ( $post ) {
	global $content_width, $_wp_additional_image_sizes;
	$image_id = get_post_meta( $post->ID, '_hero_image_id', true );
	$old_content_width = $content_width;
	$content_width = 254;
	if ( $image_id && get_post( $image_id ) ) {
		if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}
		if ( ! empty( $thumbnail_html ) ) {
			$content = $thumbnail_html;
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_hero_image_button" >' . esc_html__( 'Remove Hero image', 'text-domain' ) . '</a></p>';
			$content .= '<input type="hidden" id="upload_hero_image" name="_hero_cover_image" value="' . esc_attr( $image_id ) . '" />';
		}
		$content_width = $old_content_width;
	} else {
		$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set Hero image', 'text-domain' ) . '" href="javascript:;" id="upload_hero_image_button" id="set-listing-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set Hero image', 'text-domain' ) . '">' . esc_html__( 'Set Hero image', 'text-domain' ) . '</a></p>';
		$content .= '<input type="hidden" id="upload_hero_image" name="_hero_cover_image" value="" />';
	}
	echo $content;
}
add_action( 'save_post', 'hero_image_save', 10, 1 );
function hero_image_save ( $post_id ) {
	if( isset( $_POST['_hero_cover_image'] ) ) {
		$image_id = (int) $_POST['_hero_cover_image'];
		update_post_meta( $post_id, '_hero_image_id', $image_id );
	}
}




function add_post_meta_box() {
	add_meta_box(
		'post_meta_box', // $id
		'View Count', // $title
		'show_post_meta_box', // $callback
		'post', // $screen
		'side', // $context
		'low' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_post_meta_box' );


function show_post_meta_box() {
    wp_nonce_field( basename( __FILE__ ), 'view_meta_box_nonce' );
	global $post;  
	$view_count = (int) get_post_meta( $post->ID, 'view_count', true ); ?>

    <p>
        <input type="number" class="byline" name="view_meta[view_count]" id="view_meta[view_count]" style="width: 100%;" value="<?php echo ($view_count) ? $view_count : 0; ?>">
    </p>

    <?php 

}


function save_post_meta( $post_id, $post ) {   
	/* Verify the nonce before proceeding. */
    if ( !isset( $_POST['view_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['view_meta_box_nonce'], basename( __FILE__ ) ) )
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
	
    if(!empty($_POST['view_meta'])){

		foreach($_POST['view_meta'] as $key => $value){

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
add_action( 'save_post', 'save_post_meta', 10, 2 );