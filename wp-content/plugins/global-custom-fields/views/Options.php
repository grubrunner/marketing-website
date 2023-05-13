<?php

if (!defined('ABSPATH')) { exit; }

require_once plugin_dir_path(__DIR__) . 'assets/functions.php';

if (!class_exists('GCF_Options')) {
	class GCF_Options
	{

		/**
		 * Start things up
		 *
		 * @since 1.0.0
		 */
		public function __construct()
		{
			// We only need to register the admin panel on the back-end
			if (is_admin()) {
				add_action('admin_menu', array('GCF_Options', 'add_admin_menu'));
				add_action('admin_init', array('GCF_Options', 'register_settings'));
			}
		}

		/**
		 * Returns all plugin options
		 *
		 * @since 1.0.0
		 */
		public static function get_gcf_options()
		{
			return get_option('gcf_options')['gcf'];
		}

		/**
		 * Returns gcf (group/single)
		 *
		 * @since 1.0.0
		 */
		public static function get_gcf_option($group, $single = false, $eval = false)
		{
			$eval = filter_var($eval, FILTER_VALIDATE_BOOLEAN);
			$gcf_opts = self::get_gcf_options();
			if (isset($gcf_opts[$group])) {
				if ($single) {
					if (isset($gcf_opts[$group][$single])) {
						$return = $gcf_opts[$group][$single];
						return ($eval === true) ? self::gcf_eval($return) : $return;
					}
				} else {
					$return = $gcf_opts[$group];
					if ($eval === true) {
						foreach ($return as $key => $ret) {
							$return[$key] = self::gcf_eval($ret);
						}
					}
					return $return;
				}
			}
			return false;
		}

		/**
		 * Evaluate gcf
		 *
		 * @since 1.0.0
		 */
		public static function gcf_eval(&$field)
		{
			if (strpos($field, "[php]") !== false) {
				$field = str_replace("[php]", "<?php ", $field);
				$field = str_replace("[/php]", " ?>", $field);
				ob_start();
				eval("?>" . $field);
				$field = ob_get_contents();
				ob_end_clean();
			}
			return $field;
		}

		/**
		 * Add sub menu page
		 *
		 * @since 1.0.0
		 */
		public static function add_admin_menu()
		{
			add_menu_page(
				esc_html__('GCF', 'text-domain'),
				esc_html__('GCF', 'text-domain'),
				'manage_options',
				'GCF',
				array('GCF_Options', 'create_admin_page')
			);
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * We are only registering 1 setting so we can store all options in a single option as
		 * an array. You could, however, register a new setting for each option
		 *
		 * @since 1.0.0
		 */
		public static function register_settings()
		{
			register_setting('gcf_options', 'gcf_options', array(
				'GCF_Options',
				'sanitize'
			));
		}

		/**
		 * Sanitization callback
		 *
		 * @since 1.0.0
		 */
		public static function sanitize($options)
		{
			if ($options) {
				// Sanitize groups
				foreach ($options['gcf-fields'] as $key => $group) {
					$options['gcf-fields'][$key] = sanitize_textarea_field($options['gcf-fields'][$key]);
				}
				// Sanitize fields
				foreach ($options['gcf'] as $key_g => $group) {
					foreach ($group as $key_f => $field) {
						$options['gcf'][$key_g][$key_f] = self::sanitizeHtmlOption($options['gcf'][$key_g][$key_f]);
					}
				}
				// Sanitize settings
				$options['gcf-settings']['gcf-groups'] = sanitize_text_field($options['gcf-settings']['gcf-groups']);
				$options['gcf-settings']['gcf-html-tags'] = sanitize_textarea_field($options['gcf-settings']['gcf-html-tags']);
				$options['gcf-settings']['gcf-html-attr'] = sanitize_textarea_field($options['gcf-settings']['gcf-html-attr']);
			}
			// Return sanitized options
			return $options;
		}

		/**
		 * Sanitization html
		 *
		 * @since 1.0.0
		 */
		public static function sanitizeHtmlOption($str)
		{
			static $default_attribs = array(
				'accept' => array(), 'accept-charset' => array(), 'accesskey' => array(), 'action' => array(), 'align' => array(), 'alt' => array(), 'async' => array(), 'autocomplete' => array(), 'autofocus' => array(), 'autoplay' => array(), 'bgcolor' => array(), 'border' => array(), 'charset' => array(), 'checked' => array(), 'cite' => array(), 'class' => array(), 'color' => array(), 'cols' => array(), 'colspan' => array(), 'content' => array(), 'contenteditable' => array(), 'controls' => array(), 'coords' => array(), 'data' => array(), 'datetime' => array(), 'default' => array(), 'defer' => array(), 'dir' => array(), 'dirname' => array(), 'disabled' => array(), 'download' => array(), 'draggable' => array(), 'enctype' => array(), 'for' => array(), 'form' => array(), 'formaction' => array(), 'headers' => array(), 'height' => array(), 'hidden' => array(), 'high' => array(), 'href' => array(), 'hreflang' => array(), 'http-equiv' => array(), 'id' => array(), 'ismap' => array(), 'kind' => array(), 'label' => array(), 'lang' => array(), 'list' => array(), 'loop' => array(), 'low' => array(), 'max' => array(), 'maxlength' => array(), 'media' => array(), 'method' => array(), 'min' => array(), 'multiple' => array(), 'muted' => array(), 'name' => array(), 'novalidate' => array(), 'onabort' => array(), 'onafterprint' => array(), 'onbeforeprint' => array(), 'onbeforeunload' => array(), 'onblur' => array(), 'oncanplay' => array(), 'oncanplaythrough' => array(), 'onchange' => array(), 'onclick' => array(), 'oncontextmenu' => array(), 'oncopy' => array(), 'oncuechange' => array(), 'oncut' => array(), 'ondblclick' => array(), 'ondrag' => array(), 'ondragend' => array(), 'ondragenter' => array(), 'ondragleave' => array(), 'ondragover' => array(), 'ondragstart' => array(), 'ondrop' => array(), 'ondurationchange' => array(), 'onemptied' => array(), 'onended' => array(), 'onerror' => array(), 'onfocus' => array(), 'onhashchange' => array(), 'oninput' => array(), 'oninvalid' => array(), 'onkeydown' => array(), 'onkeypress' => array(), 'onkeyup' => array(), 'onload' => array(), 'onloadeddata' => array(), 'onloadedmetadata' => array(), 'onloadstart' => array(), 'onmousedown' => array(), 'onmousemove' => array(), 'onmouseout' => array(), 'onmouseover' => array(), 'onmouseup' => array(), 'onmousewheel' => array(), 'onoffline' => array(), 'ononline' => array(), 'onpagehide' => array(), 'onpageshow' => array(), 'onpaste' => array(), 'onpause' => array(), 'onplay' => array(), 'onplaying' => array(), 'onpopstate' => array(), 'onprogress' => array(), 'onratechange' => array(), 'onreset' => array(), 'onresize' => array(), 'onscroll' => array(), 'onsearch' => array(), 'onseeked' => array(), 'onseeking' => array(), 'onselect' => array(), 'onstalled' => array(), 'onstorage' => array(), 'onsubmit' => array(), 'onsuspend' => array(), 'ontimeupdate' => array(), 'ontoggle' => array(), 'onunload' => array(), 'onvolumechange' => array(), 'onwaiting' => array(), 'onwheel' => array(), 'open' => array(), 'optimum' => array(), 'pattern' => array(), 'placeholder' => array(), 'poster' => array(), 'preload' => array(), 'readonly' => array(), 'rel' => array(), 'required' => array(), 'reversed' => array(), 'rows' => array(), 'rowspan' => array(), 'sandbox' => array(), 'scope' => array(), 'selected' => array(), 'shape' => array(), 'size' => array(), 'sizes' => array(), 'span' => array(), 'spellcheck' => array(), 'src' => array(), 'srcdoc' => array(), 'srclang' => array(), 'srcset' => array(), 'start' => array(), 'step' => array(), 'style' => array(), 'tabindex' => array(), 'target' => array(), 'title' => array(), 'translate' => array(), 'type' => array(), 'usemap' => array(), 'value' => array(), 'width' => array(), 'wrap' => array()
			);
			$extra_attr = explode(',', get_option('gcf_options')['gcf-settings']['gcf-html-attr']);
			if(count(array_filter($extra_attr))){
				foreach ($extra_attr as $attr) {
					$default_attribs[trim($attr)] = array();
				}
			}
			$allowed_tags = array(
				'a' => $default_attribs, 'abbr' => $default_attribs, 'acronym' => $default_attribs, 'address' => $default_attribs, 'applet' => $default_attribs, 'area' => $default_attribs, 'article' => $default_attribs, 'aside' => $default_attribs, 'audio' => $default_attribs, 'b' => $default_attribs, 'base' => $default_attribs, 'basefont' => $default_attribs, 'bdi' => $default_attribs, 'bdo' => $default_attribs, 'big' => $default_attribs, 'blockquote' => $default_attribs, 'body' => $default_attribs, 'br' => $default_attribs, 'button' => $default_attribs, 'canvas' => $default_attribs, 'caption' => $default_attribs, 'center' => $default_attribs, 'cite' => $default_attribs, 'code' => $default_attribs, 'col' => $default_attribs, 'colgroup' => $default_attribs, 'data' => $default_attribs, 'datalist' => $default_attribs, 'dd' => $default_attribs, 'del' => $default_attribs, 'details' => $default_attribs, 'dfn' => $default_attribs, 'dialog' => $default_attribs, 'dir' => $default_attribs, 'div' => $default_attribs, 'dl' => $default_attribs, 'dt' => $default_attribs, 'em' => $default_attribs, 'embed' => $default_attribs, 'fieldset' => $default_attribs, 'figcaption' => $default_attribs, 'figure' => $default_attribs, 'font' => $default_attribs, 'footer' => $default_attribs, 'form' => $default_attribs, 'frame' => $default_attribs, 'frameset' => $default_attribs, 'h1' => $default_attribs, 'h2' => $default_attribs, 'h3' => $default_attribs, 'h4' => $default_attribs, 'h5' => $default_attribs, 'h6' => $default_attribs, 'head' => $default_attribs, 'header' => $default_attribs, 'hr' => $default_attribs, 'html' => $default_attribs, 'i' => $default_attribs, 'iframe' => $default_attribs, 'img' => $default_attribs, 'input' => $default_attribs, 'ins' => $default_attribs, 'kbd' => $default_attribs, 'label' => $default_attribs, 'legend' => $default_attribs, 'li' => $default_attribs, 'link' => $default_attribs, 'main' => $default_attribs, 'map' => $default_attribs, 'mark' => $default_attribs, 'meta' => $default_attribs, 'meter' => $default_attribs, 'nav' => $default_attribs, 'noframes' => $default_attribs, 'noscript' => $default_attribs, 'object' => $default_attribs, 'ol' => $default_attribs, 'optgroup' => $default_attribs, 'option' => $default_attribs, 'output' => $default_attribs, 'p' => $default_attribs, 'param' => $default_attribs, 'picture' => $default_attribs, 'pre' => $default_attribs, 'progress' => $default_attribs, 'q' => $default_attribs, 'rp' => $default_attribs, 'rt' => $default_attribs, 'ruby' => $default_attribs, 's' => $default_attribs, 'samp' => $default_attribs, 'script' => $default_attribs, 'section' => $default_attribs, 'select' => $default_attribs, 'small' => $default_attribs, 'source' => $default_attribs, 'span' => $default_attribs, 'strike' => $default_attribs, 'strong' => $default_attribs, 'style' => $default_attribs, 'sub' => $default_attribs, 'summary' => $default_attribs, 'sup' => $default_attribs, 'svg' => $default_attribs, 'table' => $default_attribs, 'tbody' => $default_attribs, 'td' => $default_attribs, 'template' => $default_attribs, 'textarea' => $default_attribs, 'tfoot' => $default_attribs, 'th' => $default_attribs, 'thead' => $default_attribs, 'time' => $default_attribs, 'title' => $default_attribs, 'tr' => $default_attribs, 'track' => $default_attribs, 'tt' => $default_attribs, 'u' => $default_attribs, 'ul' => $default_attribs, 'var' => $default_attribs, 'video' => $default_attribs, 'wbr'
			);
			$extra_tags = explode(',', get_option('gcf_options')['gcf-settings']['gcf-html-tags']);
			if(count(array_filter($extra_tags))){
				foreach ($extra_tags as $tag) {
					$allowed_tags[trim($tag)] = $default_attribs;
				}
			}
			if (function_exists('wp_kses')) {
				$str = wp_kses($str, $allowed_tags);
			} else {
				$tags = array();
				foreach (array_keys($allowed_tags) as $tag) {
					$tags[] = "<$tag>";
				}
				$str = strip_tags($str, join('', $tags));
			}
			$buffer = trim($str);
			return $buffer;
		}

		/**
		 * Settings page output
		 *
		 * @since 1.0.0
		 */
		public static function create_admin_page()
		{ ?>

			<div id="gcf-wrap">

				<h2 id="gcf-title"><?php _e('Global Custom Fields', 'global-custom-fields'); ?></h2>
				<h4><?php _e('Features', 'global-custom-fields'); ?></h4>
				<ul>
					<li><span class="dashicons dashicons-arrow-right"></span> <?php _e('Function', 'global-custom-fields'); ?> <span><?php _e('get_gcf($group, $single = false, $eval = false)', 'global-custom-fields'); ?></span> <?php _e('-', 'global-custom-fields'); ?> <small><?php _e('get group or single field, choose if eval php (default false)'); ?></small></li>
					<li><span class="dashicons dashicons-arrow-right"></span> <?php _e('Shortcode for single field', 'global-custom-fields'); ?> <span><?php _e('[gcf group="group_name" field="field_name" eval=false]', 'global-custom-fields'); ?></span> <?php _e('-', 'global-custom-fields'); ?> <small><?php _e('group & field name required, choose if eval php (default false)'); ?></small></li>
					<li><span class="dashicons dashicons-arrow-right"></span> <?php _e('Use php in fields with pseudo tags', 'global-custom-fields'); ?> <span><?php _e('[php] ... [/php]', 'global-custom-fields'); ?></span></li>
					<li><small><?php _e('N.B. Use "eval" only if you know what you\'re doing', 'global-custom-fields'); ?></small></li>
				</ul>

				<?php settings_errors(); ?>

				<h2 class="nav-tab-wrapper gcf-tabs">
					<div class="nav-tab gcf-opt-tab nav-tab-active" data-section='gcf'><?php _e('GCF', 'global-custom-fields'); ?></div>
					<div class="nav-tab gcf-opt-tab" data-section='gcf-fields'><?php _e('Fields', 'global-custom-fields'); ?></div>
					<div class="nav-tab gcf-opt-tab" data-section='gcf-settings'><?php _e('Settings', 'global-custom-fields'); ?></div>
				</h2>
				<form id='gcf-opt-form' method="post" action="options.php" autocomplete="off">

					<?php
					settings_fields('gcf_options');
					include 'GlobalCF.php';
					include 'Fields.php';
					include 'Settings.php';
					submit_button();
					?>

				</form>

			</div>
		<?php
		}
	}
}