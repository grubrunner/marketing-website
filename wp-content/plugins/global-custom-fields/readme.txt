=== Global Custom Fields ===
Contributors: tommasomeli
Tags: gcf, global custom fields, advanced, custom, field, fields
Requires at least: 3.4
Tested up to: 5.7
Requires PHP: 5.4
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create Global Custom fields and save them into WP Options, get them with PHP or use gfc Shortcode

== Description ==

Customize WordPress with Global Custom Fields! You can use GCF for example to create HTML + PHP shortcodes, global text fields, to save custom urls and retrieve them wherever you want and much more.

**Add global fields in GCF Admin Page** Create groups in the 'Settings' section and related fields in the 'Fields' section. Then edit the fields individually from the 'GCF' section.

**Recover GCF with php** Fields groups / single gcf can be retrieved anywhere within your theme / plugin with the function `get_gcf($group, $single = false, $eval = false)`

**Show single GCF with a shortcode** Load and display your single gcf with a shortcode! `[gcf group="group_name" field="field_name" eval=false]`

Each field is validated before saving. Add non-standard HTML tags and attributes in the "Settings" section if you need.

N.B. Use php "eval" only if you know what you're doing. Save php fields using pseudo tags `[php] ... [/php]`

[contact](mailto:info@tommasomeli.it) me if you have any questions, issues, or suggestions.
And leave a [review](https://wordpress.org/support/plugin/global-custom-fields/reviews/#new-post) to grow the project!

== Installation ==

1. Upload the `global-custom-fields` folder to the directory `/wp-content/plugins/`.
2. Activate the plugin using the 'Plugins' menu in WordPress.
3. Set up the plugin from GCF Admin Page
4. Use `get_gcf()` php function or `[gcf]` shortcode to add GCF anywhere! (see more in the 'Description' section)

== Screenshots ==

1. GCF Settings
2. GCF Groups
3. GCF Fields
4. GCF Fields

== Changelog ==

= 1.3 (25th March,2021) =

* WP 5.7 compatibility

= 1.2 (14th December,2020) =

* remove warnings from fields editor
* code editor fixed

= 1.1 (1th June,2020) =

* add Fields editor (with lines and code highlights)
* add extra Tags / Attributes section in settings
* fix PHP eval feature