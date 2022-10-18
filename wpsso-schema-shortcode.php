<?php
/**
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
 * Description: Schema shortcode to define and customize additional properties and types for sections of the content (WPSSO Core Premium Required).
 * Requires Plugins: wpsso
 * Requires PHP: 7.2
 * Requires At Least: 5.2
 * Tested Up To: 6.1.0
 * Version: 1.3.2
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes and/or incompatible API changes (ie. breaking changes).
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2014-2022 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoAbstractAddOn' ) ) {

	require_once dirname( __FILE__ ) . '/lib/abstract/add-on.php';
}

if ( ! class_exists( 'WpssoSsc' ) ) {

	class WpssoSsc extends WpssoAbstractAddOn {

		public $filters;	// WpssoSscFilters class object.

		protected $p;		// Wpsso class object.

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

		public function init_objects_std() {

			$this->p =& Wpsso::get_instance();

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			$doing_ajax = defined( 'DOING_AJAX' ) ? DOING_AJAX : false;

			if ( $doing_ajax ) {

				return;
			}

			$is_admin   = is_admin();
			$info       = $this->cf[ 'plugin' ][ $this->ext ];
			$req_info   = $info[ 'req' ][ 'wpsso' ];
			$notice_msg = $this->get_requires_plugin_notice( $info, $req_info );

			if ( $is_admin ) {

				$this->p->notice->err( $notice_msg );

				SucomUtil::safe_error_log( __METHOD__ . ' error: ' . $notice_msg, $strip_html = true );
			}

			if ( $this->p->debug->enabled ) {

				$this->p->debug->log( strtolower( $notice_msg ) );
			}
		}

		public function init_objects_pro() {

			$this->p =& Wpsso::get_instance();

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			if ( $this->get_missing_requirements() ) {	// Returns false or an array of missing requirements.

				return;	// Stop here.
			}

			$this->filters = new WpssoSscFilters( $this->p, $this );
		}
	}

        global $wpssossc;

	$wpssossc =& WpssoSsc::get_instance();
}
