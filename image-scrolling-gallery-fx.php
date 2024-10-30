<?php
/*
Plugin Name: Image Scrolling Gallery FX
Plugin URI: http://www.flashxml.net/image-scrolling-gallery.html
Description: An original "Image Scrolling Gallery". Completely XML customizable without any Flash knowledge. And it's free!
Version: 0.2.4
Author: FlashXML.net
Author URI: http://www.flashxml.net/
License: GPL2
*/

/* start global parameters */
	$imagescrollinggalleryfx_params = array(
		'count'	=> 0, // number of Image Scrolling Gallery FX embeds
	);
/* end global parameters */

/* start client side functions */
	function imagescrollinggalleryfx_get_embed_code($imagescrollinggalleryfx_attributes) {
		global $imagescrollinggalleryfx_params;
		$imagescrollinggalleryfx_params['count']++;

		$width = (int)$imagescrollinggalleryfx_attributes[1];
		$height = (int)$imagescrollinggalleryfx_attributes[2];

		if ($width == 0 || $height == 0) {
			return '<!-- invalid Image Scrolling Gallery FX width and / or height -->';
		}

		$plugin_dir = get_option('imagescrollinggalleryfx_path');
		if ($plugin_dir === false) {
			$plugin_dir = 'flashxml/image-scrolling-gallery-fx';
		}
		$plugin_dir = trim($plugin_dir, '/');

		$swf_embed = array(
			'width' => $width,
			'height' => $height,
			'text' => isset($imagescrollinggalleryfx_attributes[5]) ? trim($imagescrollinggalleryfx_attributes[5]) : '',
			'gallery_path' => WP_CONTENT_URL . "/{$plugin_dir}/",
			'swf_name' => 'ImageScrollingGalleryFX.swf',
		);
		$swf_embed['swf_path'] = $swf_embed['gallery_path'].$swf_embed['swf_name'];

		$settings_file_name = !empty($imagescrollinggalleryfx_attributes[4]) ? $imagescrollinggalleryfx_attributes[4] : 'settings.xml';

		if (!is_feed()) {
			$embed_code = '<div id="imagescrollinggallery-fx'.$imagescrollinggalleryfx_params['count'].'">'.$swf_embed['text'].'</div>';
			$embed_code .= '<script type="text/javascript">';
			$embed_code .= "swfobject.embedSWF('{$swf_embed['swf_path']}', 'imagescrollinggallery-fx{$imagescrollinggalleryfx_params['count']}', '{$swf_embed['width']}', '{$swf_embed['height']}', '9.0.0.0', '', { folderPath: '{$swf_embed['gallery_path']}'".($settings_file_name != 'settings.xml' ? ", settingsXML: '{$settings_file_name}', navigationSettingsXML: 'fxImageScroller/{$settings_file_name}', gallerySettingsXML: 'holder/{$settings_file_name}', " : '')." }, { scale: 'noscale', salign: 'tl', wmode: 'transparent', allowScriptAccess: 'sameDomain', allowFullScreen: true }, {});";
			$embed_code.= '</script>';
		} else {
			$embed_code = '<object width="'.$swf_embed['width'].'" height="'.$swf_embed['height'].'">';
			$embed_code .= '<param name="movie" value="'.$swf_embed['swf_path'].'"></param>';
			$embed_code .= '<param name="scale" value="noscale"></param>';
			$embed_code .= '<param name="salign" value="tl"></param>';
			$embed_code .= '<param name="wmode" value="transparent"></param>';
			$embed_code .= '<param name="allowScriptAccess" value="sameDomain"></param>';
			$embed_code .= '<param name="allowFullScreen" value="true"></param>';
			$embed_code .= '<param name="sameDomain" value="true"></param>';
			$embed_code .= '<param name="flashvars" value="folderPath='.$swf_embed['gallery_path'].($settings_file_name != 'settings.xml' ? '&settingsXML='.$settings_file_name.'&navigationSettingsXML='.$settings_file_name.'&gallerySettingsXML='.$settings_file_name : '').'"></param>';
			$embed_code .= '<embed type="application/x-shockwave-flash" width="'.$swf_embed['width'].'" height="'.$swf_embed['height'].'" src="'.$swf_embed['swf_path'].'" scale="noscale" salign="tl" wmode="transparent" allowScriptAccess="sameDomain" allowFullScreen="true" flashvars="folderPath='.$swf_embed['gallery_path'].($settings_file_name != 'settings.xml' ? '&settingsXML='.$settings_file_name.'&navigationSettingsXML=fxImageScroller/'.$settings_file_name.'&gallerySettingsXML=holder/'.$settings_file_name : '').'"';
			$embed_code .= '></embed>';
			$embed_code .= '</object>';
		}

		return $embed_code;
	}

	function imagescrollinggalleryfx_filter_content($content) {
		return preg_replace_callback('|\[image-scrolling-gallery-fx\s+width\s*=\s*"(\d+)"\s+height\s*=\s*"(\d+)"\s*(settings="([^"]+)")?\](.*)\[/image-scrolling-gallery-fx\]|i', 'imagescrollinggalleryfx_get_embed_code', $content);
	}

	function imagescrollinggalleryfx_echo_embed_code($width, $height, $div_text = '', $settings_xml = '') {
		echo imagescrollinggalleryfx_get_embed_code(array(1 => $width, 2 => $height, 4 => $settings_xml, 5 => $div_text));
	}

	function imagescrollinggalleryfx_load_swfobject_lib() {
		wp_enqueue_script('swfobject');
	}
/* end client side functions */

/* start admin section functions */
	function imagescrollinggalleryfx_admin_menu() {
		add_options_page('Image Scrolling Gallery FX Options', 'Image Scrolling Gallery FX', 'manage_options', 'imagescrollinggalleryfx', 'imagescrollinggalleryfx_admin_options');
	}

	function imagescrollinggalleryfx_admin_options() {
	  if (!current_user_can('manage_options'))  {
				wp_die(__('You do not have sufficient permissions to access this page.'));
		}

	  $imagescrollinggalleryfx_default_path = get_option('imagescrollinggalleryfx_path');
	  if ($imagescrollinggalleryfx_default_path === false) {
	  	$imagescrollinggalleryfx_default_path = 'flashxml/image-scrolling-gallery-fx';
	  }
?>
<div class="wrap">
	<h2>Image Scrolling Gallery FX</h2>
	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row" style="width: 40em;">SWF and assets path is <?php echo WP_CONTENT_DIR; ?>/</th>
				<td><input type="text" style="width: 25em;" name="imagescrollinggalleryfx_path" value="<?php echo $imagescrollinggalleryfx_default_path; ?>" /></td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="imagescrollinggalleryfx_path" />
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
</div>
<?php
	}
/* end admin section functions */

/* start hooks */
	add_filter('the_content', 'imagescrollinggalleryfx_filter_content');
	add_action('init', 'imagescrollinggalleryfx_load_swfobject_lib');
	add_action('admin_menu', 'imagescrollinggalleryfx_admin_menu');
/* end hooks */

?>