<?php
/*
 * Plugin Name: WPSSO Schema Shortcode
 * Plugin Slug: wpsso-schema-shortcode
 * Text Domain: wpsso-schema-shortcode
 * Domain Path: /languages
 * Plugin URI: https://wpsso.com/extend/plugins/wpsso-schema-shortcode/
 * Assets URI: https://surniaulula.github.io/wpsso-schema-shortcode/assets/
 * Author: JS Morisset
 * Author URI: https://wpsso.com/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Description: Schema shortcode to define and customize additional properties and types for sections of the content.
 * Requires Plugins: wpsso
 * Requires PHP: 7.4.33
 * Requires At Least: 5.9
 * Tested Up To: 6.8.3
 * Version: 2.1.0
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes and/or incompatible API changes (ie. breaking changes).
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2021-2025 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoAbstractAddOn' ) ) {

	require_once dirname( __FILE__ ) . '/lib/abstract/add-on.php';
}

if ( ! class_exists( 'WpssoSsc' ) ) {

	class WpssoSsc extends WpssoAbstractAddOn {

		protected $p;	// Wpsso class object.

		private static $instance = null;	// WpssoSsc class object.

		public function __construct() {

			parent::__construct( __FILE__, __CLASS__ );
		}

		public static function &get_instance() {

			if ( null === self::$instance ) {

				self::$instance = new self;
			}

			return self::$instance;
		}

		public function init_textdomain() {

			load_plugin_textdomain( 'wpsso-schema-shortcode', false, 'wpsso-schema-shortcode/languages/' );
		}

		/*
		 * Called by Wpsso->set_objects() which runs at init priority 10.
		 */
		public function init_objects_preloader() {

			$this->p =& Wpsso::get_instance();

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			if ( $this->get_missing_requirements() ) {	// Returns false or an array of missing requirements.

				return;	// Stop here.
			}

			new WpssoSscFilters( $this->p, $this );
		}
	}

	WpssoSsc::get_instance();
}
