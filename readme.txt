=== WPSSO Schema Shortcode ===
Plugin Name: WPSSO Schema Shortcode
Plugin Slug: wpsso-schema-shortcode
Text Domain: wpsso-schema-shortcode
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-schema-shortcode/assets/
Tags: schema, shortcode
Contributors: jsmoriss
Requires PHP: 7.2
Requires At Least: 5.2
Tested Up To: 6.0.1
WC Tested Up To: 6.6.1
Stable Tag: 1.3.2

Schema shortcode to define and customize additional properties and types for sections of the content (WPSSO Core Premium Required).

== Description ==

<!-- about -->

<p>The <a href="https://wordpress.org/plugins/wpsso/">WPSSO Core plugin</a> provides support for hundreds of Schema types, and can read data from dozens of supported third-party plugins and service APIs. The most popular Schema properties can be customized easily in the <em>Document SSO</em> metabox, and if required, the <code>&#91;schema&#93;</code> shortcode can be used to define additional properties and types for sections of the content.</p>

<p>Please note that the <code>&#91;schema&#93;</code> shortcode is meant for <strong>advanced users only</strong> and is not required for WPSSO Core to create complete and accurate Schema JSON-LD markup for the content. You should avoid using the <code>&#91;schema&#93;</code> shortcode unless you're very familiar with <a href="https://schema.org">https://schema.org</a> markup and have very specific, non-standard requirements. If you use the <code>&#91;schema&#93;</code> shortcode, make sure you always validate any change with the <a href="https://validator.schema.org/">Schema Markup Validator</a> and the <a href="https://search.google.com/test/rich-results">Google Rich Results Test</a> tool.</p>

<!-- /about -->

<p><a href="https://wpsso.com/docs/plugins/wpsso-schema-shortcode-documentation/notes-and-documentation-for-wpsso-ssc/schema-shortcode/">You can view the complete Schema shortcode guide here</a>.</p>

<h3>WPSSO Core Premium Required</h3>

WPSSO Schema Shortcode (WPSSO SSC) is an add-on for the [WPSSO Core Premium plugin](https://wpsso.com/).

== Installation ==

<h3 class="top">Install and Uninstall</h3>

* [Install the WPSSO Schema Shortcode add-on](https://wpsso.com/docs/plugins/wpsso-schema-shortcode/installation/install-the-plugin/).
* [Uninstall the WPSSO Schema Shortcode add-on](https://wpsso.com/docs/plugins/wpsso-schema-shortcode/installation/uninstall-the-plugin/).

== Frequently Asked Questions ==

<h3 class="top">Frequently Asked Questions</h3>

* None.

<h3>Notes and Documentation</h3>

* None.

== Screenshots ==

== Changelog ==

<h3 class="top">Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes and/or incompatible API changes (ie. breaking changes).
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev &lt; a (alpha) &lt; b (beta) &lt; rc (release candidate).

<h3>Standard Edition Repositories</h3>

* [GitHub](https://surniaulula.github.io/wpsso-schema-shortcode/)

<h3>Development Version Updates</h3>

<p><strong>WPSSO Core Premium customers have access to development, alpha, beta, and release candidate version updates:</strong></p>

<p>Under the SSO &gt; Update Manager settings page, select the "Development and Up" (for example) version filter for the WPSSO Core plugin and/or its add-ons. Save the plugin settings and click the "Check for Plugin Updates" button to fetch the latest version information. When new development versions are available, they will automatically appear under your WordPress Dashboard &gt; Updates page. You can always reselect the "Stable / Production" version filter at any time to reinstall the latest stable version.</p>

<h3>Changelog / Release Notes</h3>

**Version 1.3.2 (2022/03/26)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Removed `$check_dupes` from all methods arguments.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v11.8.0.

**Version 1.3.1 (2022/03/07)**

Maintenance release.

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v11.5.0.

**Version 1.3.0 (2022/01/19)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Renamed the lib/abstracts/ folder to lib/abstract/.
	* Renamed the `SucomAddOn` class to `SucomAbstractAddOn`.
	* Renamed the `WpssoAddOn` class to `WpssoAbstractAddOn`.
	* Renamed the `WpssoWpMeta` class to `WpssoAbstractWpMeta`.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v9.14.0.

**Version 1.2.0 (2021/11/16)**

* **New Features**
	* None.
* **Improvements**
	* Added dependency check for WPSSO Core (Premium).
* **Bugfixes**
	* None.
* **Developer Notes**
	* Refactored the `SucomAddOn->get_missing_requirements()` method.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v9.8.0.

**Version 1.1.0 (2021/10/18)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Removed cache clearing on activation / deactivation.
* **Requires At Least**
	* PHP v7.0.
	* WordPress v5.0.
	* WPSSO Core v9.0.0.

**Version 1.0.0 (2021/09/24)**

* **New Features**
	* Initial release.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.0.
	* WordPress v5.0.
	* WPSSO Core v9.0.0.

== Upgrade Notice ==

= 1.3.2 =

(2022/03/26) Removed `$check_dupes` from all methods arguments.

= 1.3.1 =

(2022/03/07) Maintenance release.

= 1.3.0 =

(2022/01/19) Renamed the lib/abstracts/ folder and its classes.

= 1.2.0 =

(2021/11/16) Added dependency check for WPSSO Core (Premium).

= 1.1.0 =

(2021/10/18) Removed cache clearing on activation / deactivation.

= 1.0.0 =

(2021/09/24) Initial release.

