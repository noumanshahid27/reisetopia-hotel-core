<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class Reisetopia_Hotel_Core_Helpers
 *
 * This class contains repetitive functions that
 * are used globally within the plugin.
 *
 * @package		REISETOPIA
 * @subpackage	Classes/Reisetopia_Hotel_Core_Helpers
 * @author		Nouman shahid
 * @since		1.0.0
 */
 define( 'REISETOPIA_ACF_PATH', __DIR__ . '/acf/' );
define( 'REISETOPIA_ACF_URL', plugin_dir_url( __FILE__ ) . 'acf/' );

class Reisetopia_Hotel_Core_Helpers{
    public $post_type_name ='reisetopia_hotel';

	function __construct(){
        add_action( 'init', array($this, 'reisetopia_hotel_post_type')); // create custom post type
        add_filter( 'acf/settings/show_admin', '__return_false' ); //hide admin menu page for acf
        add_filter( 'acf/settings/show_updates', '__return_false', 100 ); // hide updates
        add_action( 'acf/init', array($this, 'reisetopia_acf_fields')); // create acf fields
        add_action( 'rest_api_init', array($this, 'reisetopia_hotel_api_enpoints' )); // add rest api endpoints
  
    
    
}
// Register Custom Post Type

public function reisetopia_hotel_post_type() {

	$labels = array(
		'name'                  => _x( 'Reisetopia Hotels', 'Post Type General Name', 'reisetopia' ),
		'singular_name'         => _x( 'Reisetopia Hotel', 'Post Type Singular Name', 'reisetopia' ),
		'menu_name'             => __( 'Reisetopia Hotel', 'reisetopia' ),
		'name_admin_bar'        => __( 'Reisetopia Hotel', 'reisetopia' ),
		'archives'              => __( 'Reisetopia Hotel Archives', 'reisetopia' ),
		'attributes'            => __( 'Reisetopia Hotel Attributes', 'reisetopia' ),
		'parent_item_colon'     => __( 'Parent Reisetopia Hotel:', 'reisetopia' ),
		'all_items'             => __( 'All Reisetopia Hotels', 'reisetopia' ),
		'add_new_item'          => __( 'Add New Reisetopia Hotel', 'reisetopia' ),
		'add_new'               => __( 'Add New', 'reisetopia' ),
		'new_item'              => __( 'New Reisetopia Hotel', 'reisetopia' ),
		'edit_item'             => __( 'Edit Reisetopia Hotel', 'reisetopia' ),
		'update_item'           => __( 'Update Reisetopia Hotel', 'reisetopia' ),
		'view_item'             => __( 'View Reisetopia Hotel', 'reisetopia' ),
		'view_items'            => __( 'View Reisetopia Hotel', 'reisetopia' ),
		'search_items'          => __( 'Search Reisetopia Hotel', 'reisetopia' ),
		'not_found'             => __( 'Not found', 'reisetopia' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'reisetopia' ),
		'featured_image'        => __( 'Featured Image', 'reisetopia' ),
		'set_featured_image'    => __( 'Set featured image', 'reisetopia' ),
		'remove_featured_image' => __( 'Remove featured image', 'reisetopia' ),
		'use_featured_image'    => __( 'Use as featured image', 'reisetopia' ),
		'insert_into_item'      => __( 'Insert into item', 'reisetopia' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'reisetopia' ),
		'items_list'            => __( 'Items list', 'reisetopia' ),
		'items_list_navigation' => __( 'Items list navigation', 'reisetopia' ),
		'filter_items_list'     => __( 'Filter items list', 'reisetopia' ),
	);
	$args = array(
		'label'                 => __( 'Reisetopia Hotel', 'reisetopia' ),
		'description'           => __( 'Reisetopia Hotel description', 'reisetopia' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'custom-fields' ),
		'taxonomies'            => array(''),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-building',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( $this->post_type_name, $args );
	
}
// add Acf fields

public function reisetopia_acf_fields(){
    if(function_exists( 'acf_add_local_field_group' )){
        	acf_add_local_field_group( array(
        	'key' => 'reisetopia_hotel_custom_fields',
        	'title' => 'Hotel Details',
        	'fields' => array(
        		array(
        			'key' => 'reisetopia_hotel_city',
        			'label' => 'City',
        			'name' => 'city',
        			'aria-label' => '',
        			'type' => 'text',
        			'instructions' => '',
        			'required' => 1,
        			'conditional_logic' => 0,
        			'wrapper' => array(
        				'width' => '',
        				'class' => '',
        				'id' => '',
        			),
        			'default_value' => '',
        			'maxlength' => '',
        			'placeholder' => '',
        			'prepend' => '',
        			'append' => '',
        		),
        		array(
        			'key' => 'reisetopia_hotel_country',
        			'label' => 'Country',
        			'name' => 'country',
        			'aria-label' => '',
        			'type' => 'text',
        			'instructions' => '',
        			'required' => 1,
        			'conditional_logic' => 0,
        			'wrapper' => array(
        				'width' => '',
        				'class' => '',
        				'id' => '',
        			),
        			'default_value' => '',
        			'maxlength' => '',
        			'placeholder' => '',
        			'prepend' => '',
        			'append' => '',
        		),
        		array(
        			'key' => 'reisetopia_hotel_max_price',
        			'label' => 'Price Range (Max)',
        			'name' => 'price_range_max',
        			'aria-label' => '',
        			'type' => 'number',
        			'instructions' => '',
        			'required' => 1,
        			'conditional_logic' => 0,
        			'wrapper' => array(
        				'width' => '',
        				'class' => '',
        				'id' => '',
        			),
        			'default_value' => '',
        			'min' => '',
        			'max' => '',
        			'placeholder' => '',
        			'step' => '',
        			'prepend' => '',
        			'append' => '',
        		),
        		array(
        			'key' => 'reisetopia_hotel_min_price',
        			'label' => 'Price Range (Min)',
        			'name' => 'price_range_min',
        			'aria-label' => '',
        			'type' => 'number',
        			'instructions' => '',
        			'required' => 1,
        			'conditional_logic' => 0,
        			'wrapper' => array(
        				'width' => '',
        				'class' => '',
        				'id' => '',
        			),
        			'default_value' => '',
        			'min' => '',
        			'max' => '',
        			'placeholder' => '',
        			'step' => '',
        			'prepend' => '',
        			'append' => '',
        		),
        	    array(
        			'key' => 'reisetopia_hotel_rating',
        			'label' => 'Rating',
        			'name' => 'rating',
        			'aria-label' => '',
        			'type' => 'number',
        			'instructions' => '',
        			'required' => 0,
        			'conditional_logic' => 0,
        			'wrapper' => array(
        				'width' => '',
        				'class' => '',
        				'id' => '',
        			),
        			'default_value' => '',
        			'min' => '',
        			'max' => '',
        			'placeholder' => '',
        			'step' => '',
        			'prepend' => '',
        			'append' => '',
        		),
        	),
        	'location' => array(
        		array(
        			array(
        				'param' => 'post_type',
        				'operator' => '==',
        				'value' => $this->post_type_name,
        			),
        		),
        	),
        	'menu_order' => 0,
        	'position' => 'normal',
        	'style' => 'default',
        	'label_placement' => 'top',
        	'instruction_placement' => 'label',
        	'hide_on_screen' => '',
        	'active' => true,
        	'description' => '',
        	'show_in_rest' => 1,
        ) );
    }
}
public function reisetopia_hotel_api_enpoints(){
   
    // get all hotel list endpoint
    register_rest_route(
        'reisetopia-hotels/v1',
        '/hotels(?:/(?P<name>[a-z0-9-]+)?:/&location=(?P<location>[a-z0-9-]+)?:/&max_price=(?P<max_price>\d+))?',
        array(
            array(
                'methods'  => 'GET',
                'callback' =>  array($this, 'get_reisetopia_hotels_posts_callback' ),
                
            ),
        )
    );
    // get specific hotel endpoint
     register_rest_route(
        'reisetopia-hotels/v1',
        '/hotels/(?P<id>\d+)',
        array(
            array(
                'methods'  => 'GET',
                'callback' =>  array($this, 'get_reisetopia_hotels_by_id_callback' ),
                'args'     => array(
                    'id' => array(
                        'required' => true,
                        'validate_callback' =>     function( $param, $request, $key ) {
                            return is_numeric( $param );
                        },
                    ),
              ), 
            ),
        )
    );
}
public function get_reisetopia_hotels_posts_callback($request){
   // Initialize the array that will receive the posts' data. 
    $reisetopia_hotels_data = array();
    // get and set the parameter
    $paged = $request->get_param( 'page' );
    $paged = ( isset( $paged ) || ! ( empty( $paged ) ) ) ? $paged : 1; 
    // Get the hotels
    $hotel_name = $request['name'];
    $hotel_location = $request['location'];
    $hotel_max_price = $request['max_price'];
    $args = array(
            'paged' => $paged,
            'posts_per_page' => -1,            
            'post_type' => array( $this->post_type_name) // This is the line that allows to fetch multiple post types. 
        );
    if($hotel_name){
        $args['s'] = $hotel_name;
    }
    if($hotel_location){
        $args['meta_query'] = array(
            'relation' => 'OR',
            array(
                'key' => 'city',
                'value' => $hotel_location,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'country',
                'value' => $hotel_location,
                'compare' => 'LIKE'
            ),
        );
    }
    if($hotel_max_price){
         $args['meta_query'] = array(
            'relation' => 'OR',
            array(
                'key' => 'price_range_max',
                'compare' => '<=',
                'value'     => intval($hotel_max_price),
                'type'      => 'numeric'
            ),
            
        );
    }
    $reisetopia_hotels_list = get_posts($args); 
    
    if ( empty( $reisetopia_hotels_list ) ) {
    return new WP_Error( 'no_hotel_found', 'No Hotel found', array( 'status' => 200 ) );
  }
    // Loop through the posts and push the desired data to the array we've initialized earlier in the form of an object
    foreach( $reisetopia_hotels_list as $hotel ) {
        $post_id = $hotel->ID; 
        $hotel_city= get_field('city' ,$post_id);
        $hotel_country= get_field('country' ,$post_id);
        $hotel_min_price = get_field('price_range_min',$post_id);
        $hotel_max_price = get_field('price_range_max' ,$post_id);
        $hotel_rating = get_field('rating' ,$post_id);
        $reisetopia_hotels_data[] = (object) array( 
            'id' => $post_id, 
            'name' => $hotel->post_title, 
            'city' => $hotel_city,
            'country' => $hotel_country,
            'prieRange'=> (object) array(
                'min'=> $hotel_min_price,
                'max'=> $hotel_max_price,
            ),
        );
        if($hotel_rating){
          $reisetopia_hotels_data['rating'] = $hotel_rating;
        }
        
    }    
    return $reisetopia_hotels_data;        
}
// get hotel by id endpoint callback
public function get_reisetopia_hotels_by_id_callback($request){
    if ( false === $request['id'] ) {
                return new WP_Error(
                  'rest_comment_karma_failed',
                  __( 'Failed to update comment karma.' ),
                  array( 'status' => 500 )
                );
            }
   // Initialize the array that will receive the posts' data. 
    $reisetopia_hotels_data = array();
    //get post id
     $post_id = $request['id'];
    // Get the posts using the 'post' and 'news' post types
    $reisetopia_hotels_list = get_posts( array(
            'post__in' => array($post_id),
            'post_type' => array( $this->post_type_name) // This is the line that allows to fetch multiple post types. 
        )
    ); 
    if ( empty( $reisetopia_hotels_list ) ) {
    return new WP_Error( 'no_hotel_found', 'No Hotel found', array( 'status' => 200 ) );
    }
    // Loop through the posts and push the desired data to the array we've initialized earlier in the form of an object
    foreach( $reisetopia_hotels_list as $hotel ) {
        $post_id = $hotel->ID; 
        $hotel_city= get_field('city' ,$post_id);
        $hotel_country= get_field('country',$post_id);
        $hotel_min_price = get_field('price_range_min',$post_id);
        $hotel_max_price = get_field('price_range_max',$post_id);
        $hotel_rating = get_field('rating',$post_id);
        if($hotel_rating){
            $reisetopia_hotels_data['rating'] = $hotel_rating;
        }
        $reisetopia_hotels_data[] = (object) array( 
            'id' => $post_id, 
            'name' => $hotel->post_title, 
            'city' => $hotel_city,
            'country' => $hotel_country,
            'prieRange'=> (object) array(
                'min'=> $hotel_min_price,
                'max'=> $hotel_max_price,
            ),
        );
    }                  
    return $reisetopia_hotels_data;        
}
}
