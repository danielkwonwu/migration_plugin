<?php
/**
 * 
 * @package migration
 */
/*
Plugin Name: Migration Test Plugin
Plugin URI: http://karen-plugin.com
Description: A plugin that will move the content from the old theme to the new theme
Version: 1.0.0
Author: Karen Ye
Author URI: http://ikarenye.com
License: GPLv2 or later
Text Domain: karen-plugin
*/
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
Copyright 2005-2019 Automattic, Inc.
*/ 
/*
Copy this to debug:
$my_file = 'testing.txt';
$handle = fopen($my_file, 'w') or die('Cannot open file: ' .$my_file);
file_put_contents($my_file, "debug");
*/
defined ('ABSPATH') or die('Access file denied.');
class migrationTest {
    function __construct() {
        
    }
    function activate() {
        flush_rewrite_rules();
    }
    function deactivate() {
        flush_rewrite_rules();
    }
    
}

if (class_exists('migrationTest')) {
    $pluginObj = new migrationTest();
}

function takePostContent($post_id) {


    $post_list = get_posts( array(
        'orderby'    => 'menu_order',
        'sort_order' => 'asc'
    ) );

    $page_list = get_pages( array(
        'orderby'    => 'menu_order',
        'sort_order' => 'asc'
    ) );

    $returnData = json_encode(array_merge($post_list, $page_list));
    
    $my_file = 'testing.txt';
    $handle = fopen($my_file, 'w') or die('Cannot open file: ' .$my_file);
    file_put_contents('testing.txt', $returnData);
}

add_action( 'plugins_loaded', 'takePostContent', 10, 1 );


// activation
register_activation_hook(__FILE__, array($pluginObj, 'activate'));// this array will access the funciton in the class

// deactivation
register_deactivation_hook(__FILE__, array($pluginObj, 'deactivate'));


?>