<?php
/**
* Plugin Name: Software Pages
* URI: http://oweissbarth.de
* Description: Adds software pages with metadata and downloads to your wordpress blog.
* Version: 0.01
* Author: Oliver Weissbarth
* URI: http://oweissbarth.de
* License: GPLv2
*/

/*
	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

defined( 'ABSPATH' ) or die('No script kiddies please!');

global $sp_settings;

$sp_settings = array(
					"use_dm" => (get_option("sp_use_dm")=="on"),
					"page_slug" => get_option("sp_page_slug"),
					"default_styles" => get_option("sp_default_styles"));


include_once("sp_posttype.php");
include_once("sp_downloads.php");
include_once("sp_settings.php");


function sp_activate(){
	sp_create_post_types();
	flush_rewrite_rules();
}

function sp_deactivate(){
	flush_rewrite_rules();
}


register_activation_hook( __FILE__, 'sp_activate' );
register_deactivation_hook( __FILE__, 'sp_deactivate' );
