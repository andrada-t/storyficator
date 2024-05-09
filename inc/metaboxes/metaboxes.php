<?php
// Define the custom field callback function
function storyfi_render_post_id_field_callback( $field_args, $field ) {
    $post_id = get_the_ID(); // Get the current post ID
    echo '<input type="text" class="cmb2-text-medium" value="'.esc_html(get_post_meta(get_the_ID(), 'storify_shortcode_value', true)).'" readonly>';
}

// Hook the custom field callback function to a CMB2 field
add_action( 'cmb2_render_post_id_field', 'storyfi_render_post_id_field_callback', 10, 2 );

add_filter( 'cmb2_admin_init', 'storyfi_metaboxes' );
function storyfi_metaboxes() {
  	/**
  	||-> Metaboxes: For CPT - [storyfi]
  	*/
  	$fields_group = new_cmb2_box( array(
		'id'           => 'storyfi_carousel_group',
		'title'        => esc_html__( 'Fields', 'storyfi' ),
		'object_types' => array( 'storyfi' ),
	) );

	// $fields_group_id is the field id string, so in this case: 'yourprefix_group_demo'
	$fields_group_id = $fields_group->add_field( array(
		'id'          => 'storyfi_carousel_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'	=> esc_html__( 'Item', 'storyfi' ),
			'add_button'  	=> esc_html__( 'Add New Item', 'storyfi' ),
			'remove_button' => esc_html__( 'Delete Item', 'storyfi' ),
			'sortable'      => true,
			'closed'      	=> true, 
			'remove_confirm'=> esc_html__( 'Are you sure you want to delete this item?', 'storyfi' ),
		),
	) );

	$fields_group->add_group_field( $fields_group_id, array(
		'name'       => esc_html__( 'Title', 'storyfi' ),
		'id'         => 'storyfi_carousel_title',
		'type' 		 => 'text'
	) );

	$fields_group->add_group_field( $fields_group_id, array(
		'name'       => esc_html__( 'Banner', 'storyfi' ),
		'id'         => 'storyfi_carousel_img',
		'type' 		 => 'file',
		'save_id'    => true,
		'allow'      => array( 'url', 'attachment' )
	) );

	$fields_group = new_cmb2_box( array(
        'id'           => 'storyfi_shortcode_group',
        'title'        => esc_html__( 'Shortcode', 'storyfi' ),
        'object_types' => array( 'storyfi' ),
        'priority'     => 'high',
  	) );
  	$fields_group->add_field(
		array(
			'id'   => 'storyfi_shortcode',
        	'type' => 'post_id_field',
		)
	);
}
