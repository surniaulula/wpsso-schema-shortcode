<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2021-2023 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoSscFilters' ) ) {

	class WpssoSscFilters {

		private $p;		// Wpsso class object.
		private $a;		// WpssoSsc class object.

		/**
		 * Instantiated by WpssoSsc->init_objects().
		 */
		public function __construct( &$plugin, &$addon ) {

			static $do_once = null;

			if ( true === $do_once ) {

				return;	// Stop here.
			}

			$do_once = true;

			$this->p =& $plugin;
			$this->a =& $addon;

			$this->p->util->add_plugin_filters( $this, array(
				'json_data_graph_element' => 5,
			), $prio = -1000 );	// Run first.
		}

		public function filter_json_data_graph_element( $json_data, $mod, $mt_og, $page_type_id, $is_main ) {

			if ( ! $is_main ) {

				return $json_data;
			}

			if ( $mod[ 'is_post' ] ) {

				$content = get_post_field( 'post_content', $mod[ 'id' ] );

				if ( empty( $content ) ) {

					if ( $this->p->debug->enabled ) {

						$this->p->debug->log( 'post_content for post ID ' . $mod[ 'id' ] . ' is empty' );
					}

				/**
				 * Check if the schema shortcode class is loaded.
				 */
				} elseif ( isset( $this->p->sc[ 'schema' ] ) && is_object( $this->p->sc[ 'schema' ] ) ) {

					/**
					 * Check if the shortcode is registered, and that the content has a schema shortcode.
					 */
					if ( has_shortcode( $content, WPSSOSSC_SCHEMA_SHORTCODE_NAME ) ) {

						$content_data = $this->p->sc[ 'schema' ]->content_json_data( $content );

						if ( $this->p->debug->enabled ) {

							$this->p->debug->log_arr( 'content_data', $content_data );
						}

						if ( ! empty( $content_data ) ) {

							$json_data = WpssoSchema::return_data_from_filter( $json_data, $content_data );
						}

					} elseif ( $this->p->debug->enabled ) {

						$this->p->debug->log( 'schema shortcode skipped - no schema shortcode in content' );
					}

				} elseif ( $this->p->debug->enabled ) {

					$this->p->debug->log( 'schema shortcode skipped - schema class not loaded' );
				}

			} elseif ( $this->p->debug->enabled ) {

				$this->p->debug->log( 'schema shortcode skipped - module is not a post object' );
			}

			return $json_data;
		}
	}
}
