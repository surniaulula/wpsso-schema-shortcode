<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2021-2023 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoSscConfig' ) ) {

	class WpssoSscConfig {

		public static $cf = array(
			'plugin' => array(
				'wpssossc' => array(			// Plugin acronym.
					'version'     => '1.4.1-dev.6',	// Plugin version.
					'opt_version' => '1',		// Increment when changing default option values.
					'short'       => 'WPSSO SSC',	// Short plugin name.
					'name'        => 'WPSSO Schema Shortcode',
					'desc'        => 'Schema shortcode to define and customize additional properties and types for sections of the content.',
					'slug'        => 'wpsso-schema-shortcode',
					'base'        => 'wpsso-schema-shortcode/wpsso-schema-shortcode.php',
					'update_auth' => '',		// No premium version.
					'text_domain' => 'wpsso-schema-shortcode',
					'domain_path' => '/languages',

					/*
					 * Required plugin and its version.
					 */
					'req' => array(
						'wpsso' => array(
							'name'          => 'WPSSO Core (Premium)',
							'home'          => 'https://wordpress.org/plugins/wpsso/',
							'plugin_class'  => 'Wpsso',
							'version_const' => 'WPSSO_VERSION',
							'min_version'   => '14.7.0-dev.6',
						),
					),

					/*
					 * URLs or relative paths to plugin banners and icons.
					 */
					'assets' => array(

						/*
						 * Icon image array keys are '1x' and '2x'.
						 */
						'icons' => array(
							'1x' => 'images/icon-128x128.png',
							'2x' => 'images/icon-256x256.png',
						),
					),

					/*
					 * Library files loaded and instantiated by WPSSO.
					 */
					'lib' => array(
						'shortcode' => array(
							'schema' => 'Schema Shortcode',
						),
					),
				),
			),
		);

		public static function get_version( $add_slug = false ) {

			$info =& self::$cf[ 'plugin' ][ 'wpssossc' ];

			return $add_slug ? $info[ 'slug' ] . '-' . $info[ 'version' ] : $info[ 'version' ];
		}

		public static function set_constants( $plugin_file ) {

			if ( defined( 'WPSSOSSC_VERSION' ) ) {	// Define constants only once.

				return;
			}

			$info =& self::$cf[ 'plugin' ][ 'wpssossc' ];

			/*
			 * Define fixed constants.
			 */
			define( 'WPSSOSSC_FILEPATH', $plugin_file );
			define( 'WPSSOSSC_PLUGINBASE', $info[ 'base' ] );	// Example: wpsso-schema-shortcode/wpsso-schema-shortcode.php.
			define( 'WPSSOSSC_PLUGINDIR', trailingslashit( realpath( dirname( $plugin_file ) ) ) );
			define( 'WPSSOSSC_PLUGINSLUG', $info[ 'slug' ] );	// Example: wpsso-schema-shortcode.
			define( 'WPSSOSSC_URLPATH', trailingslashit( plugins_url( '', $plugin_file ) ) );
			define( 'WPSSOSSC_VERSION', $info[ 'version' ] );

			/*
			 * Define variable constants.
			 */
			self::set_variable_constants();
		}

		public static function set_variable_constants( $var_const = null ) {

			if ( ! is_array( $var_const ) ) {

				$var_const = (array) self::get_variable_constants();
			}

			/*
			 * Define the variable constants, if not already defined.
			 */
			foreach ( $var_const as $name => $value ) {

				if ( ! defined( $name ) ) {

					define( $name, $value );
				}
			}
		}

		public static function get_variable_constants() {

			$var_const = array();

			$var_const[ 'WPSSOSSC_SCHEMA_SHORTCODE_NAME' ]      = 'schema';
			$var_const[ 'WPSSOSSC_SCHEMA_SHORTCODE_SEPARATOR' ] = '_';
			$var_const[ 'WPSSOSSC_SCHEMA_SHORTCODE_DEPTH' ]     = 3;

			/*
			 * Maybe override the default constant value with a pre-defined constant value.
			 */
			foreach ( $var_const as $name => $value ) {

				if ( defined( $name ) ) {

					$var_const[$name] = constant( $name );
				}
			}

			return $var_const;
		}

		public static function require_libs( $plugin_file ) {

			require_once WPSSOSSC_PLUGINDIR . 'lib/filters.php';
			require_once WPSSOSSC_PLUGINDIR . 'lib/register.php';

			add_filter( 'wpssossc_load_lib', array( __CLASS__, 'load_lib' ), 10, 3 );
		}

		public static function load_lib( $success = false, $filespec = '', $classname = '' ) {

			if ( false !== $success ) {

				return $success;
			}

			if ( ! empty( $classname ) ) {

				if ( class_exists( $classname ) ) {

					return $classname;
				}
			}

			if ( ! empty( $filespec ) ) {

				$file_path = WPSSOSSC_PLUGINDIR . 'lib/' . $filespec . '.php';

				if ( file_exists( $file_path ) ) {

					require_once $file_path;

					if ( empty( $classname ) ) {

						$classname = SucomUtil::sanitize_classname( 'wpssossc' . $filespec, $allow_underscore = false );
					}

					return $classname;
				}
			}

			return $success;
		}
	}
}
