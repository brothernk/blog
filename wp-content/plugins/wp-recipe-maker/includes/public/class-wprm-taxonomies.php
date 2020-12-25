<?php
/**
 * Register the recipe taxonomies.
 *
 * @link       http://bootstrapped.ventures
 * @since      1.0.0
 *
 * @package    WP_Recipe_Maker
 * @subpackage WP_Recipe_Maker/includes/public
 */

/**
 * Register the recipe taxonomies.
 *
 * @since      1.0.0
 * @package    WP_Recipe_Maker
 * @subpackage WP_Recipe_Maker/includes/public
 * @author     Brecht Vandersmissen <brecht@bootstrapped.ventures>
 */
class WPRM_Taxonomies {

	/**
	 * Register actions and filters.
	 *
	 * @since    1.0.0
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ), 2 );
	}

	/**
	 * Register the recipe taxonomies.
	 *
	 * @since    1.0.0
	 */
	public static function register_taxonomies() {
		$taxonomies = WPRM_Taxonomies::get_taxonomies_to_register();

		foreach ( $taxonomies as $taxonomy => $labels ) {
			$args = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'public'            => false,
				'show_ui' 			=> false,
				'query_var'         => false,
				'rewrite'           => false,
				'show_in_rest'      => true,
			);

			register_taxonomy( $taxonomy, WPRM_POST_TYPE, $args );
			register_taxonomy_for_object_type( $taxonomy, WPRM_POST_TYPE );

			if ( 'wprm_suitablefordiet' === $taxonomy ) {
				self::check_diet_taxonomy_terms();
			}
		}
	}

	/**
	 * Get the recipe taxonomies to register.
	 *
	 * @since    1.0.0
	 */
	public static function get_taxonomies_to_register() {
		$taxonomies = apply_filters( 'wprm_recipe_taxonomies', array(
			'wprm_course' => array(
				'name'               => _x( 'Courses', 'taxonomy general name', 'wp-recipe-maker' ),
				'singular_name'      => _x( 'Course', 'taxonomy singular name', 'wp-recipe-maker' ),
			),
			'wprm_cuisine' => array(
				'name'               => _x( 'Cuisines', 'taxonomy general name', 'wp-recipe-maker' ),
				'singular_name'      => _x( 'Cuisine', 'taxonomy singular name', 'wp-recipe-maker' ),
			),
			'wprm_suitablefordiet' => array(
				'name'               => _x( 'Diets', 'taxonomy general name', 'wp-recipe-maker' ),
				'singular_name'      => _x( 'Diet', 'taxonomy singular name', 'wp-recipe-maker' ),
			),
			'wprm_keyword' => array(
				'name'               => _x( 'Keywords', 'taxonomy general name', 'wp-recipe-maker' ),
				'singular_name'      => _x( 'Keyword', 'taxonomy singular name', 'wp-recipe-maker' ),
			),
			'wprm_ingredient' => array(
				'name'               => _x( 'Ingredients', 'taxonomy general name', 'wp-recipe-maker' ),
				'singular_name'      => _x( 'Ingredient', 'taxonomy singular name', 'wp-recipe-maker' ),
			),
			'wprm_equipment' => array(
				'name'               => _x( 'Equipment', 'taxonomy general name', 'wp-recipe-maker' ),
				'singular_name'      => _x( 'Equipment', 'taxonomy singular name', 'wp-recipe-maker' ),
			),
		));

		if ( false === WPRM_Settings::get( 'metadata_suitablefordiet' ) ) {
			unset( $taxonomies['wprm_suitablefordiet'] );
		}

		return $taxonomies;
	}

	/**
	 * Get the recipe taxonomies.
	 *
	 * @since    1.10.0
	 * @param    boolean $include_internal Wether to include taxonomies used internally.
	 */
	public static function get_taxonomies( $include_internal = false ) {
		$taxonomies = self::get_taxonomies_to_register();
		if ( ! $include_internal ) {
			unset( $taxonomies['wprm_ingredient'] );
			unset( $taxonomies['wprm_equipment'] );
		}

		return $taxonomies;
	}

	/**
	 * Check if a recipe taxonomy exists.
	 *
	 * @since    1.13.0
	 * @param    mixed $taxonomy Name of the taxonomy to check.
	 */
	public static function exists( $taxonomy ) {
		$taxonomies = self::get_taxonomies_to_register();
		return array_key_exists( $taxonomy, $taxonomies );
	}

	/**
	 * Insert default terms for recipe taxonomies.
	 *
	 * @since    1.0.0
	 */
	public static function insert_default_taxonomy_terms() {
		if ( taxonomy_exists( 'wprm_course' ) ) {
			wp_insert_term( __( 'Breakfast',    'wp-recipe-maker' ), 'wprm_course' );
			wp_insert_term( __( 'Appetizer',    'wp-recipe-maker' ), 'wprm_course' );
			wp_insert_term( __( 'Soup',         'wp-recipe-maker' ), 'wprm_course' );
			wp_insert_term( __( 'Main Course',  'wp-recipe-maker' ), 'wprm_course' );
			wp_insert_term( __( 'Side Dish',    'wp-recipe-maker' ), 'wprm_course' );
			wp_insert_term( __( 'Salad',        'wp-recipe-maker' ), 'wprm_course' );
			wp_insert_term( __( 'Dessert',      'wp-recipe-maker' ), 'wprm_course' );
			wp_insert_term( __( 'Snack',        'wp-recipe-maker' ), 'wprm_course' );
			wp_insert_term( __( 'Drinks',       'wp-recipe-maker' ), 'wprm_course' );
		}

		if ( taxonomy_exists( 'wprm_cuisine' ) ) {
			wp_insert_term( __( 'French',           'wp-recipe-maker' ), 'wprm_cuisine' );
			wp_insert_term( __( 'Italian',          'wp-recipe-maker' ), 'wprm_cuisine' );
			wp_insert_term( __( 'Mediterranean',    'wp-recipe-maker' ), 'wprm_cuisine' );
			wp_insert_term( __( 'Indian',           'wp-recipe-maker' ), 'wprm_cuisine' );
			wp_insert_term( __( 'Chinese',          'wp-recipe-maker' ), 'wprm_cuisine' );
			wp_insert_term( __( 'Japanese',         'wp-recipe-maker' ), 'wprm_cuisine' );
			wp_insert_term( __( 'American',         'wp-recipe-maker' ), 'wprm_cuisine' );
			wp_insert_term( __( 'Mexican',          'wp-recipe-maker' ), 'wprm_cuisine' );
		}

		self::check_diet_taxonomy_terms();
	}

	/**
	 * Check diet taxonomy terms.
	 *
	 * @since    5.9.0
	 */
	public static function check_diet_taxonomy_terms() {
		if ( taxonomy_exists( 'wprm_suitablefordiet' ) ) {
			$terms = array(
				'DiabeticDiet' 		=> __( 'Diabetic', 'wp-recipe-maker' ),
				'GlutenFreeDiet'	=> __( 'Gluten Free', 'wp-recipe-maker' ),
				'HalalDiet'			=> __( 'Halal', 'wp-recipe-maker' ),
				'HinduDiet'			=> __( 'Hindu', 'wp-recipe-maker' ),
				'KosherDiet'		=> __( 'Kosher', 'wp-recipe-maker' ),
				'LowCalorieDiet'	=> __( 'Low Calorie', 'wp-recipe-maker' ),
				'LowFatDiet'		=> __( 'Low Fat', 'wp-recipe-maker' ),
				'LowLactoseDiet'	=> __( 'Low Lactose', 'wp-recipe-maker' ),
				'LowSaltDiet'		=> __( 'Low Salt', 'wp-recipe-maker' ),
				'VeganDiet'			=> __( 'Vegan', 'wp-recipe-maker' ),
				'VegetarianDiet'	=> __( 'Vegetarian', 'wp-recipe-maker' ),
			);

			if ( count( array_keys( $terms ) ) !== wp_count_terms( 'wprm_suitablefordiet', array( 'hide_empty' => false ) ) ) {
				foreach ( $terms as $term => $label ) {
					$existing_term = term_exists( $term, 'wprm_suitablefordiet' );
					if ( $existing_term ) {
						$existing_term_id = $existing_term['term_id'];

						if ( $existing_term_id ) {
							$existing_term_label = get_term_meta( $existing_term_id, 'wprm_term_label', true );

							if ( ! $existing_term_label ) {
								update_term_meta( $existing_term_id, 'wprm_term_label', $label );
							}
						}
					} else {
					  	wp_insert_term( $term, 'wprm_suitablefordiet' );
					}
				}
			}
		}
	}
}

WPRM_Taxonomies::init();
