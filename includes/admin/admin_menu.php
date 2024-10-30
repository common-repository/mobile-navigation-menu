<?php
/**
 * WP Submenu and Add and Update Options
 *
 * @since 1.0.0
 * @todo Replace only if your creating your own Plugin
 * @todo mnm - Find all and replace text
 * @todo Mobile Navigation Menu - Find all and replace text
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

/**
 * Sub menu hooks (unused)
 * 
 *
 * @since 1.0
 * @return void
 */

function mnm_register_menu() {
	add_management_page( 
		__( 'Set Mobile Navigation Menu', 'mnm-txt' ), // Page Title
		__( 'Mobile Navigation Menu', 'mnm-txt' ), // Menu Title
		 'manage_options', // Capability
		 'mnm-menu-page', // Menu Slug 
		 'mnm_admin_menu_page' ); // Function
}
add_action( 'admin_menu', 'mnm_register_menu');

function load_wp_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );
/**
 * WP Options (Get, Update, and Add)
 *
 * @see Options API (https://codex.wordpress.org/Options_API)
 */
function mnm_admin_menu_page() {

	// $_POST needs to be sanitized
	if(isset($_POST['submit'])
		&& check_admin_referer('mnm_option_action','mnm_option_field') // @see WP Docs for check_admin_referer()
	){

		/** Array DB $options; if emtpy assign empty string */
		$options = array(
			'mnm_option_1' => isset($_POST["mnm_option_1"]) ? $_POST["mnm_option_1"]  : "",
			'mnm_option_2' => isset($_POST['mnm_option_2']) ? $_POST['mnm_option_2']  : "",
			'mnm_option_3' => isset($_POST['mnm_option_3']) ? $_POST['mnm_option_3']  : "",
			'mnm_option_4' => isset($_POST['mnm_option_4']) ? $_POST['mnm_option_4']  : "",
			'mnm_option_5' => isset($_POST['mnm_option_5']) ? $_POST['mnm_option_5']  : "",
			'mnm_option_6' => isset($_POST['mnm_option_6']) ? $_POST['mnm_option_6']  : "",
			'mnm_option_7' => isset($_POST['mnm_option_7']) ? $_POST['mnm_option_7']  : "",
			'mnm_option_8' => isset($_POST['mnm_option_8']) ? $_POST['mnm_option_8']  : "",
			'mnm_option_12' => isset($_POST['mnm_option_12']) ? $_POST['mnm_option_12']  : array(),
		);

		/* Handling var Array */	
		foreach($options as $option_name => $option_value) {
			// If option name exist, update it; else add it!
			if ( get_option( $option_name ) !== false ) {
				update_option($option_name, $option_value);
			} else {	
				add_option( $option_name, $option_value, '', 'yes');
			}
		}
	}

?>	
	<div id="mnm-setting-page" class="wrap">
		<h1><?php _e('Mobile Navigation Menu Settings', 'mnm-txt'); ?></h1>
		<span class="title"><?php _e('Configuration Settings for Mobile Navigation Menu Plugin', 'mnm-txt'); ?></span>
		<form method="post" action="<?php echo esc_attr($_SERVER["REQUEST_URI"]); ?>">
			<?php wp_nonce_field('mnm_option_action','mnm_option_field'); ?>
			<table class="form-table form-table-mnm-1">
				<tbody>
					<tr>
						<td>
						<h3><label for="general"><?php _e('General Settings', 'mnm-txt'); ?></label></h3>
						<p>
							<input class="mnm_option_1" name="mnm_option_1" type="checkbox" value="1" <?php checked(get_option('mnm_option_1'), 1); ?>>
							<label><?php _e('Disable <kbd>WP Admin Bar</kbd> in the frontend', 'mnm-txt'); ?></label>
						</p>
						<p>
							<input class="mnm_option_8" name="mnm_option_8" type="checkbox" value="1" <?php checked(get_option('mnm_option_8'), 1); ?>>
							<label><?php _e('Disable <kbd>Font Awesome</kbd>. <b>Some themes have font awesome installed</b>.', 'mnm-txt'); ?></label>
						</p>
						<p>
							<input class="mnm_option_6" name="mnm_option_6" type="text" value="<?php echo get_option('mnm_option_6', '720'); ?>">
							<label><?php _e('<i>Default: <code>720</code>px</i>. <b>Breakpoint mobile menu to show at</b>.', 'mnm-txt'); ?></label>
						</p>
						<p>
							<input id="mnm-image_url" class="mnm_option_7 regular-text" name="mnm_option_7" type="text" value="<?php echo get_option('mnm_option_7', 'MENU'); ?>">
							<button type="button" id="insert-logo-mnm" class="button insert-logo add_media"><span class="dashicons dashicons-format-image" style="vertical-align: text-top;"></span> Add Logo</button>
							<div><label><?php _e('<i>Default: <code>MENU</code></i>. <b>Upload your Logo or simply put a text label</b>.', 'mnm-txt'); ?></label></div>
						</p>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('#insert-logo-mnm').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Logo',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            // console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#mnm-image_url').val(image_url);
        });
    });
});
</script>
						<p>
							<input class="mnm_option_8" name="mnm_option_8" type="text" value="<?php echo get_option('mnm_option_8', 'nav:first'); ?>">
							<label><?php _e('<i>e.g. <code>.navclass</code>, <code>#navid</code></i>. <b>Navigation Menu Selector</b>.', 'mnm-txt'); ?></label>
							<div><?php _e('<i>Default: Automatically detects the first <code>nav</code> DOM matches. See jQuery <a target="_blank" href="//api.jquery.com/category/selectors/">Selectors</a></i>', 'mnm-txt'); ?></div>
						</p>

						</td>
					</tr>
	
				</tbody>
			</table>
			<table class="form-table form-table-mnm-2">
				<tbody>
					<tr>
						<td>
						<h3><label for="form-table-2"><?php _e('Color Settings', 'mnm-txt'); ?></label></h3>
						<span class="title"><?php _e('Pick the following colors for your Mobile Menu', 'mnm-txt'); ?></span>
						<p>
							<input class="mnm_option_2 mnm-color-field" name="mnm_option_2" type="text" value="<?php echo get_option('mnm_option_2', '#333333'); ?>">
							<label style="vertical-align: super;"><?php _e('<i>Default: <code>#333333</code></i>. <b>Menu Background Color</b>.', 'mnm-txt'); ?></label>
						</p>
						<p>
							<input class="mnm_option_3 mnm-color-field" name="mnm_option_3" type="text" value="<?php echo get_option('mnm_option_3', '#dddddd'); ?>">
							<label style="vertical-align: super;"><?php _e('<i>Default: <code>#dddddd</code></i>. <b>Icon Color</b>.', 'mnm-txt'); ?></label>
						</p>
						<p>
							<input class="mnm_option_4 mnm-color-field" name="mnm_option_4" type="text" value="<?php echo get_option('mnm_option_4', '#c4c4c4'); ?>">
							<label style="vertical-align: super;"><?php _e('<i>Default: <code>#c4c4c4</code></i>. <b>Text Color</b>.', 'mnm-txt'); ?></label>
						</p>
						<p>
							<input class="mnm_option_5 mnm-color-field" name="mnm_option_5" type="text" value="<?php echo get_option('mnm_option_5', '#222222'); ?>">
							<label style="vertical-align: super;"><?php _e('<i>Default: <code>#222222</code></i>. <b>Navigation Background Color</b>.', 'mnm-txt'); ?></label>
						</p>						
				
						</td>
					</tr>
	
				</tbody>
			</table>

			<table class="form-table-mnm-3">
					<thead>
						<tr><td><h3><label for="icon"><?php _e('Icon Settings', 'mnm-txt'); ?></label></h3></td></tr>
					<tr align="center">
						<th align="left"><label for="label name"><?php _e('Label', 'mnm-txt'); ?></th>
						<th align="left"><label for="icon name"><?php _e('Icon Name <a style="text-decoration: inherit;" target="_blank" href="//fontawesome.io/icons/"><span class="dashicons dashicons-info"></span></a>', 'mnm-txt'); ?></th>
						<th align="left"><label for="url"><?php _e('URL', 'mnm-txt'); ?></th>
						<th align="left"><span class="dashicons dashicons-plus mnm-plus"></span></th>
					</tr>
				 	</thead>
				 	<tbody>
				 	<tr align="center">
				 		
						<td><input class="mnm_option_12_label" name="mnm_option_12[label][]" type="text"></td>
						<td><input class="mnm_option_12_icon" name="mnm_option_12[icon][]" type="text"></td>
						<td><input class="mnm_option_12_url" name="mnm_option_12[url][]" type="text" placeholder="http://"></td>
						<td><span class="dashicons dashicons-no mnm-no"></span></td>
					</tr>
					<?php 
						$site_url = get_site_url();
						$default_opt7 = array(	"label"	=> array("", "Home", "About", "Contact"), 
												"icon"	=> array("", "fa-home", "fa-info-circle", "fa-envelope"),
											 	"url"	=> array("", $site_url."/", $site_url."/about-us", $site_url."/contact-us")
										);
						$nmn_option_7 = get_option('mnm_option_12', $default_opt7);
						if(isset($nmn_option_7) && !empty($nmn_option_7)):
							for($i=1; $i<count($nmn_option_7["label"]); $i++):	
					?>
					<tr align="center">
						<td><input class="mnm_option_12_label" name="mnm_option_12[label][]" type="text" value="<?php echo $nmn_option_7["label"][$i]; ?>"></td>
						<td><input class="mnm_option_12_icon" name="mnm_option_12[icon][]" type="text" value="<?php echo $nmn_option_7["icon"][$i]; ?>"></td>
						<td><input class="mnm_option_12_url" name="mnm_option_12[url][]" type="text" value="<?php echo $nmn_option_7["url"][$i]; ?>" placeholder="http://"></td>
						<td><span class="dashicons dashicons-no mnm-no"></span></td>
					</tr>
					<?php 
							endfor;
						endif;
					?>
	
					</tbody>
			</table>

			<table class="form-table form-table-mnm-4">
				<tbody> 
					<tr>
						<td>
							<h3 class="title"><?php _e('Follow Me', 'mnm-txt'); ?></h3>
							<span><?php _e('Is this helpful? Questions? Suggestions?', 'mnm-txt'); ?></span>
							<p>
								<?php _e('Please follow <a target="_blank" href="https://twitter.com/esstat17">@esstat17</a> on Twitter.', 'mnm-txt'); ?>
							</p>
						</td>

					</tr>

				</tbody>
			</table>
			<p class="submit"><input type="submit" name="submit" class="button-primary" value="<?php _e('Save Changes', 'mnm-txt'); ?>" /></p>
		</form>
	</div>

<?php 	
}





