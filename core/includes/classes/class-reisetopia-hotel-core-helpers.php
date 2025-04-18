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
    /**post type**/
    
    public $post_type_name;
    
    /**post_per_page***/
    
     public $default_posts_per_page;
     
    /*** namespace for rest-api**/
    
    public $namespace;
    
    /*** rest-base***/
    
    public $rest_base;

	function __construct(){
	    // default variable values
	    $this->post_type_name = 'reisetopia_hotel';
        $this->default_posts_per_page = get_option( 'posts_per_page' );
        $this->namespace = 'reisetopia-hotels/v1';
        $this->rest_base = 'hotels';
        add_action( 'init', array($this, 'reisetopia_hotel_post_type')); // create custom post type
        add_filter( 'acf/settings/show_admin', '__return_false' ); //hide admin menu page for acf
        add_filter( 'acf/settings/show_updates', '__return_false', 100 ); // hide updates
        add_action( 'acf/init', array($this, 'reisetopia_acf_fields')); // create acf fields
        add_action( 'rest_api_init', array($this, 'reisetopia_hotel_api_enpoints' )); // add rest api endpoints
        // ajax function
        add_action( 'wp_ajax_reisetopia_hotels_get_all',         array($this, 'reisetopia_hotels_get_all') );
        add_action( 'wp_ajax_nopriv_reisetopia_hotels_get_all',  array($this, 'reisetopia_hotels_get_all') );
        // get single hotel by id with ajax
        add_action( 'wp_ajax_reisetopia_hotels_get_by_id',         array($this, 'reisetopia_hotels_get_by_id') );
        add_action( 'wp_ajax_nopriv_reisetopia_hotels_get_by_id',  array($this, 'reisetopia_hotels_get_by_id') );
        
  
    
    
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
        $this->namespace,
        '/'.$this->rest_base,
        array(
            array(
                'methods'  => 'GET',
                'callback' =>  array($this, 'get_reisetopia_hotels_posts_callback' ),
                'args'     => array(
                    'name' => array(
            			'required' => false,
            			'type' => 'string',
            		),
            		 'location' => array(
            			'required' => false,
            			'type' => 'string',
            		),
            		'min_price' => array(
                        'required' => false,
                        'type' => 'numeric',
                    ),
                    'max_price' => array(
                        'required' => false,
                        'type' => 'numeric',
                    ),
                    'orderby'=> array(
                        'required' => false,
                        'type' => 'string',
                    ),
                    'order'=> array(
                        'required' => false,
                        'type' => 'string',
                    ),
                    'page'=> array(
                        'required' => false,
                        'type' => 'numeric',
                    ),
                    'per_page'=> array(
                        'required' => false,
                        'type' => 'numeric',
                    ),
              ), 
            ),
        )
    );
    // get specific hotel endpoint
     register_rest_route(
        $this->namespace,
        '/'.$this->rest_base.'/(?P<id>\d+)',
        array(
            array(
                'methods'  => 'GET',
                'callback' =>  array($this, 'get_reisetopia_hotels_by_id_callback' ),
                'args'     => array(
                    'id' => array(
                        'required' => true,
                        'type' => 'numeric',
                    ),
              ), 
            ),
        )
    );
}
public function get_reisetopia_hotels_posts_callback($request){
    if ($request->get_param('max_price') && !is_numeric($request->get_param('max_price') ) ) {
        return new WP_Error( 'invalid_max_price', 'The max_price parameter must be a numeric value.', array( 'status' => 400 ) );
    }
   // Initialize the array that will receive the hotels' data. 
    $reisetopia_hotels_data = array();
   $meta_query = array();
    // Get the hotels
    $hotel_name = $request['name'];
    $hotel_location = $request['location'];
    $hotel_max_price = $request['max_price'];
    $hotel_min_price = $request['min_price'];
    $paged = $request['page'] ? $request['page'] : 1;
    $post_per_page = $request['per_page'] ? $request['per_page'] : $this->default_posts_per_page ;
    $order_by = $request['orderby'] ? $request['orderby'] : 'title';
    $order = $request['order'] ? $request['order'] : 'ASC';
    // conditon for location and max_price 
    if($hotel_location){
        $meta_query[] = array(
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
         $meta_query[]= array(
            'relation' => 'OR',
            array(
                'key' => 'price_range_max',
                'compare' => '<=',
                'value'     => intval($hotel_max_price),
                'type'      => 'numeric'
            ),
            
        );
    }
    if($hotel_min_price){
         $meta_query[]= array(
            'relation' => 'OR',
             array(
                'key' => 'price_range_min',
                'compare' => '>=',
                'value'     => intval($hotel_min_price),
                'type'      => 'numeric'
            ),
            
        );
    }
   
    if($order_by == 'price_range_min' || $order_by == 'price_range_max'){
        $args['meta_key']=$order_by;
        $order_by = 'meta_value_num';
    }
    $args = array(
            'paged'=>$paged,
            'posts_per_page' => $post_per_page,            
            'post_type' => array( $this->post_type_name), 
            'meta_query' => $meta_query,
            'orderby'          => $order_by,
		    'order'            => $order,
            's'=> $hotel_name ? $hotel_name : '',
        );
    $reisetopia_hotels_list = get_posts($args);
    $total_hotels =  count($reisetopia_hotels_list);
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
        $hotel_item_data =  array( 
            'id' => $post_id, 
            'name' => $hotel->post_title, 
            'city' => $hotel_city,
            'country' => $hotel_country,
            'priceRange'=>  array(
                'min'=> $hotel_min_price,
                'max'=> $hotel_max_price,
            ),
        );
        if($hotel_rating){
            $hotel_item_data['rating'] = $hotel_rating;
        }
        $reisetopia_hotels_data[] = $hotel_item_data;
    }    
    return $reisetopia_hotels_data;        
}
// get hotel by id endpoint callback
public function get_reisetopia_hotels_by_id_callback($request){
    if ( !is_numeric($request->get_param('id') ) ) {
        return new WP_Error( 'invalid_hotel_id', 'The id parameter must be a numeric value.', array( 'status' => 400 ) );
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
        $hotel_rating = get_field('rating' ,$post_id);
        $hotel_item_data =  array( 
            'id' => $post_id, 
            'name' => $hotel->post_title, 
            'city' => $hotel_city,
            'country' => $hotel_country,
            'priceRange'=>  array(
                'min'=> $hotel_min_price,
                'max'=> $hotel_max_price,
            ),
        );
        if($hotel_rating){
            $hotel_item_data['rating'] = $hotel_rating;
        }
        $reisetopia_hotels_data[] = $hotel_item_data;
    }                  
    return $reisetopia_hotels_data;        
}
// ajax function
public function reisetopia_hotels_get_all() {
    // check none for security
     check_ajax_referer('reisetopia_ajax_nonce', 'security');
    $success = null;
    $reisetopia_hotels_data = array();
    $meta_query = array();
    $paged = intval($_POST['page']) ? intval($_POST['page']) : 1;
    $post_per_page = intval($_POST['per_page']) ? intval($_POST['per_page']) : $this->default_posts_per_page ;
    $hotel_name =sanitize_text_field($_POST['hotel_name']); 
    $hotel_location = sanitize_text_field($_POST['hotel_location']);
    $hotel_max_price = intval($_POST['max_price']);
    $hotel_min_price = intval($_POST['min_price']); 
    $order_by = $_POST['order_by'] ? $_POST['order_by'] : 'title';
    $order = $_POST['order'] ? $_POST['order'] : 'ASC';
    if($hotel_location){
        $meta_query[]= array(
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
         $meta_query[]= array(
            'relation' => 'OR',
            array(
                'key' => 'price_range_max',
                'compare' => '<=',
                'value'     => $hotel_max_price,
                'type'      => 'numeric'
            ),
            
        );
    }
        if($hotel_min_price){
         $meta_query[]= array(
            'relation' => 'OR',
             array(
                'key' => 'price_range_min',
                'compare' => '>=',
                'value'     => $hotel_min_price,
                'type'      => 'numeric'
            ),
            
        );
    }
    if($order_by == 'price_range_min' || $order_by == 'price_range_max'){
        $args['meta_key']=$order_by;
        $order_by = 'meta_value_num';
    }
    $args = array(
            'paged'=>$paged,
            'posts_per_page' => $post_per_page,            
            'post_type' => array( $this->post_type_name), 
            'meta_query' => $meta_query,
            'orderby'          => $order_by,
		    'order'            => $order,
            's'=> $hotel_name ? $hotel_name : '',
    );
    $reisetopia_hotels_list = get_posts($args); 
    if ( empty( $reisetopia_hotels_list ) ) {
         $result['code'] = 'no_hotel_found';
         $result['message'] = 'No Hotel Found';
         wp_send_json( $result );
    }
    // Loop through the posts and push the desired data to the array we've initialized earlier in the form of an object
    foreach( $reisetopia_hotels_list as $hotel ) {
        $post_id = $hotel->ID; 
        $hotel_city= get_field('city' ,$post_id);
        $hotel_country= get_field('country' ,$post_id);
        $hotel_min_price = get_field('price_range_min',$post_id);
        $hotel_max_price = get_field('price_range_max' ,$post_id);
         $hotel_rating = get_field('rating' ,$post_id);
        $hotel_item_data =  array( 
            'id' => $post_id, 
            'name' => $hotel->post_title, 
            'city' => $hotel_city,
            'country' => $hotel_country,
            'priceRange'=>  array(
                'min'=> $hotel_min_price,
                'max'=> $hotel_max_price,
            ),
        );
        if($hotel_rating){
            $hotel_item_data['rating'] = $hotel_rating;
        }
        $reisetopia_hotels_data[] = $hotel_item_data;
        
    }    
    wp_send_json( $reisetopia_hotels_data );
}
// ajax function for single hotel by id
public function reisetopia_hotels_get_by_id(){
     check_ajax_referer('reisetopia_ajax_nonce', 'security');
     
    $success = null;
    $reisetopia_hotels_data = array();
     //get post id
     $post_id = $_POST['id'];
    // Get the posts using the 'post' and 'news' post types
    $reisetopia_hotels_list = get_posts( array(
            'post__in' => array($post_id),
            'post_type' => array( $this->post_type_name) // This is the line that allows to fetch multiple post types. 
        )
    );
    if ( empty( $reisetopia_hotels_list ) ) {
         $result['code'] = 'no_hotel_found';
         $result['message'] = 'No Hotel Found';
         wp_send_json( $result );
    }
    // Loop through the posts and push the desired data to the array we've initialized earlier in the form of an object
    foreach( $reisetopia_hotels_list as $hotel ) {
        $post_id = $hotel->ID; 
        $hotel_city= get_field('city' ,$post_id);
        $hotel_country= get_field('country' ,$post_id);
        $hotel_min_price = get_field('price_range_min',$post_id);
        $hotel_max_price = get_field('price_range_max' ,$post_id);
         $hotel_rating = get_field('rating' ,$post_id);
        $hotel_item_data =  array( 
            'id' => $post_id, 
            'name' => $hotel->post_title, 
            'city' => $hotel_city,
            'country' => $hotel_country,
            'priceRange'=>  array(
                'min'=> $hotel_min_price,
                'max'=> $hotel_max_price,
            ),
        );
        if($hotel_rating){
            $hotel_item_data['rating'] = $hotel_rating;
        }
        $reisetopia_hotels_data[] = $hotel_item_data;
        
    }    
    wp_send_json( $reisetopia_hotels_data );
}
}
