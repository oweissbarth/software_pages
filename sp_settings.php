<?php

defined( 'ABSPATH' ) or die('No script kiddies please!');

function sp_add_settings_page(){
    add_options_page( "Software Pages", "Software pages", "manage_options", "softp", "sp_settings_page");
    
	add_action('admin_init', 'sp_register_settings');
}
add_action('admin_menu', 'sp_add_settings_page');


function sp_register_settings(){
	register_setting('sp_settings_group', 'sp_use_dm');
	register_setting('sp_settings_group', 'sp_page_slug');
	register_setting('sp_settings_group', 'sp_default_styles');

}

function sp_settings_page(){
	?>
	<div class="wrap">
	<h2>Software Pages</h2>

	<form method="post" action="options.php">
	    <?php settings_fields( 'sp_settings_group' ); ?>
	    <?php do_settings_sections( 'sp_settings_group' ); ?>
	    <table class="form-table">
	        <tr valign="top">
	        <th scope="row">I want to use Download Monitor for download management</th>
	        <td><input type="checkbox" name="sp_use_dm" <?php echo (strcmp(get_option('sp_use_dm'), "on")==0 ? "checked" : "") ?> /></td>
	        </tr>
	        <tr valign="top">
	        <th scope="row">Select page to display the software list</th>
	        <td><input type="text" name="sp_page_slug" value="<?php echo get_option('sp_page_slug')?>" /></td>
	        </tr>
	        <tr valign="top">
	        <th scope="row">Apply default styles</th>
	        <td><input type="checkbox" name="sp_default_styles" <?php echo (strcmp(get_option('sp_default_styles'), "on")==0 ? "checked" : "") ?> /></td>
	        </tr>
	    </table>
    
    <?php submit_button(); ?>
	</form>
	</div>
	<?php
}

?>