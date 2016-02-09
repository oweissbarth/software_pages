<?php

defined( 'ABSPATH' ) or die('No script kiddies please!');


add_action('init', 'sp_create_post_types');
function sp_create_post_types(){
	register_post_type('sp_software_page',
						array(
							'labels' => array(
								'name' => 'Software',
								'singular_name' => 'Software',
								'menu_name' => 'Software',
								'name_admin_bar' => 'Software',
								'add_new_item' => 'Add new Software',
								'new_item' => 'New Software',
								'view_item' => 'View Software',
								'search_item' => 'Search Software',
								'not_found' => 'No Software found',
								'not_found_in_trash' => 'No Software found in trash'
							),
						'public' => true,
						'has_archive' => false,
						)
					);
}


add_action('add_meta_boxes_sp_software_page', 'sp_add_custom_metabox');
function sp_add_custom_metabox(){
	add_meta_box(
		'sp_software_pages_meta',
		'Software Meta',
		'sp_show_custom_metabox',
		'sp_software_page',
		'normal',
		'core');
}

function sp_show_custom_metabox(){
	global $sp_settings;
	global $post;
	
	wp_nonce_field( basename( __FILE__ ), 'sp_software_pages_meta_nonce' );

	?>		
			<table>
				<tr>
					<td><label>Author</label></td>
					<td><input type="text" name="sp_author" placeholder="Probably your Name" value="<?php echo esc_attr(get_post_meta($post->ID, "sp_author", true))?>"></td>
				</tr>
				<tr>
					<td><label>License</label></td>
					<td><input type="text" name="sp_license" placeholder="Name of the License" value="<?php echo esc_attr(get_post_meta($post->ID, "sp_license", true))?>"/></td>
				</tr>
				<tr>
					<td><label>Catchphrase</label></td>
					<td><input type="text" name="sp_catchphrase" placeholder="One phrase to describe your product" value="<?php echo esc_attr(get_post_meta($post->ID, "sp_catchphrase", true))?>"></td>
				</tr>
				<tr>
					<td><label>Description</label>
					<td><textarea rows=8 name="sp_description"><?php echo esc_attr(get_post_meta($post->ID, "sp_description", true))?></textarea></td>
				</tr>
				<tr>
					<td><label>Download</label></td>
					<?php if($sp_settings["use_dm"]):
						global $wpdb;
						$results = $wpdb->get_results("SELECT post_name, id FROM `wp_posts` WHERE `post_type`='dlm_download'");
						$active_dl = get_post_meta($post->ID, "sp_download", true);?>
					<td><select name="sp_download">
						<?php foreach($results as $result):?>
						<option value="<?php echo $result->id ?>" <?php if($result->id == $active_dl){echo"selected";}?>><?php echo $result->post_name ?></option>
						<?php endforeach;?>
					</select></td>
					<?php else:?> 
					<td><input name="sp_download" type="file"/></td>
					<?php endif;?>
				</tr>
				<tr>
					<td><label>Version</label></td>
					<td><input type="text" name="sp_version" placeholder="version" value="<?php echo esc_attr(get_post_meta($post->ID, "sp_version", true))?>"/></td>
				</tr>
				<tr>
					<td><label>Platform</label></td>
					<td><input type="text" name="sp_platform" value="<?php echo esc_attr(get_post_meta($post->ID, "sp_platform", true))?>"/></td>
				</tr>
				<tr>
					<td><label>Language</label></td>
					<td><input type="text" name="sp_language" value="<?php echo esc_attr(get_post_meta($post->ID, "sp_language", true))?>"/></td>
				</tr>
				<tr>
					<td><label>Icon</label></td>
					<td><input type="hidden" id="sp_icon" name="sp_icon" value="<?php echo esc_attr(get_post_meta($post->ID, "sp_icon", true))?>" />
						<img width="200" id="sp_icon_preview" src="<?php echo esc_attr(get_post_meta($post->ID, "sp_icon", true))?>"/>
						<input id="upload_image_button" type="button" value="Upload Image" />
					</td>
				</tr>
			</table>
			<script language="JavaScript">
				jQuery(document).ready(function() {

					jQuery('#upload_image_button').click(function(e) {
					    e.preventDefault();

					    var custom_uploader = wp.media({
					        title: 'Select software icon',
					        button: {
					            text: 'select icon'
					        },
					        multiple: false  // Set this to true to allow multiple files to be selected
					    })
					    .on('select', function() {
					        var attachment = custom_uploader.state().get('selection').first().toJSON();
					        jQuery('#sp_icon').val(attachment.url);
					        jQuery('#sp_icon_preview').attr("src", attachment.url);
					    })
					    .open();
});

				});
			</script>

			<style>
			table{
				width: 100%;
			}
			input, select, textarea{
				width: 70%;
			}
			</style>

	<?php
}

add_action("save_post_sp_software_page", "sp_save_meta_data");
function sp_save_meta_data($post_id){
	/* Verify the nonce before proceeding. */


  	if ( !isset( $_POST['sp_software_pages_meta_nonce'] ) || !wp_verify_nonce( $_POST['sp_software_pages_meta_nonce'],basename( __FILE__ ) ) ){
  		error_log("nonce checking failed");
    	return $post_id;
  	}
		


	$meta_field_names = array("sp_author", "sp_license", "sp_catchphrase", "sp_version", "sp_platform", "sp_language", "sp_download", "sp_icon", "sp_description");

	foreach($meta_field_names as $field){
			

		$new_value = ( isset( $_POST[$field] ) ? esc_attr( $_POST[$field] ) : '' );
		$old_value = get_post_meta($post_id, $field, true);

		if($new_value && $old_value == ''){
			add_post_meta($post_id, $field, $new_value, true);
		}elseif($new_value && $old_value != $new_value){
			update_post_meta($post_id, $field, $new_value);
		}elseif($old_value && $new_value == ''){
			delete_post_meta($post_id, $field, $old_value);
		}
	}

}

function sp_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery');
}

function sp_admin_styles() {
	wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'sp_admin_scripts');
add_action('admin_print_styles', 'sp_admin_styles');



add_filter( 'page_template', 'sp_page_template' );
function sp_page_template( $page_template ){
	global $sp_settings;
    if ( is_page( $sp_settings["page_slug"] ) ) {
        $page_template = dirname( __FILE__ ) . '/page-software.php';
    }
    return $page_template;
}
?>