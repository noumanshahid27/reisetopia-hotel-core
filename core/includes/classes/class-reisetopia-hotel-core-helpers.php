<?php

// Exit if accessed directly.
if (! defined('ABSPATH')) exit;

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
define('REISETOPIA_ACF_PATH', __DIR__ . '/acf/');
define('REISETOPIA_ACF_URL', plugin_dir_url(__FILE__) . 'acf/');

class Reisetopia_Hotel_Core_Helpers
{
	public $post_type_name = 'reisetopia_hotel';

	function __construct()
	{
		add_action('init', array($this, 'reisetopia_hotel_post_type')); // create custom post type
		add_filter('acf/settings/show_admin', '__return_false'); //hide admin menu page for acf
		add_filter('acf/settings/show_updates', '__return_false', 100); // hide updates
		add_action('acf/init', array($this, 'reisetopia_acf_fields')); // create acf fields



	}
	// Register Custom Post Type

	public function reisetopia_hotel_post_type()
	{

		$labels = array(
			'name'                  => _x('Reisetopia Hotels', 'Post Type General Name', 'reisetopia'),
			'singular_name'         => _x('Reisetopia Hotel', 'Post Type Singular Name', 'reisetopia'),
			'menu_name'             => __('Reisetopia Hotel', 'reisetopia'),
			'name_admin_bar'        => __('Reisetopia Hotel', 'reisetopia'),
			'archives'              => __('Reisetopia Hotel Archives', 'reisetopia'),
			'attributes'            => __('Reisetopia Hotel Attributes', 'reisetopia'),
			'parent_item_colon'     => __('Parent Reisetopia Hotel:', 'reisetopia'),
			'all_items'             => __('All Reisetopia Hotels', 'reisetopia'),
			'add_new_item'          => __('Add New Reisetopia Hotel', 'reisetopia'),
			'add_new'               => __('Add New', 'reisetopia'),
			'new_item'              => __('New Reisetopia Hotel', 'reisetopia'),
			'edit_item'             => __('Edit Reisetopia Hotel', 'reisetopia'),
			'update_item'           => __('Update Reisetopia Hotel', 'reisetopia'),
			'view_item'             => __('View Reisetopia Hotel', 'reisetopia'),
			'view_items'            => __('View Reisetopia Hotel', 'reisetopia'),
			'search_items'          => __('Search Reisetopia Hotel', 'reisetopia'),
			'not_found'             => __('Not found', 'reisetopia'),
			'not_found_in_trash'    => __('Not found in Trash', 'reisetopia'),
			'featured_image'        => __('Featured Image', 'reisetopia'),
			'set_featured_image'    => __('Set featured image', 'reisetopia'),
			'remove_featured_image' => __('Remove featured image', 'reisetopia'),
			'use_featured_image'    => __('Use as featured image', 'reisetopia'),
			'insert_into_item'      => __('Insert into item', 'reisetopia'),
			'uploaded_to_this_item' => __('Uploaded to this item', 'reisetopia'),
			'items_list'            => __('Items list', 'reisetopia'),
			'items_list_navigation' => __('Items list navigation', 'reisetopia'),
			'filter_items_list'     => __('Filter items list', 'reisetopia'),
		);
		$args = array(
			'label'                 => __('Reisetopia Hotel', 'reisetopia'),
			'description'           => __('Reisetopia Hotel description', 'reisetopia'),
			'labels'                => $labels,
			'supports'              => array('title', 'thumbnail', 'custom-fields'),
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
		register_post_type($this->post_type_name, $args);
	}
	// add Acf fields

	public function reisetopia_acf_fields()
	{
		if (function_exists('acf_add_local_field_group')) {
			acf_add_local_field_group(array(
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
						'label' => 'Ratning',
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
			));
		}
	}
}
