<?php
/*
Plugin Name:       From Plugin Lrb
Plugin URI:        https://lrbinventiveit.com/from-plugin
Description:       Customs From Plugin
Version:           1.10.3
Requires at least: 5.6
Tested up to:      5.7
Requires PHP:      5.6
Author:            lrbinventiveit
Author URI:        https://lrbinventiveit.com/
License:           GPL v2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:       from-plugin 
*/

if(!defined('ABSPATH')){
    header("Location: /");
    die("");
}

define("PLUGIN_VERSION","1.0.0");

//helper main file
define("PLUGIN_MAIN_FILE",plugin_dir_path(__FILE__));

//helper public file
define("PLUGIN_PUBLIC_FILE",PLUGIN_MAIN_FILE.'/public');
include PLUGIN_PUBLIC_FILE.'/public-plugin.php';

//helper admin file
define("PLUGIN_ADMIN_FILE",PLUGIN_MAIN_FILE.'/admin');
include PLUGIN_ADMIN_FILE.'/admin-plugin.php';


function from_plugin_activate() {

//db

global $wpdb;
$table_name_from = "wpt0_custom_from_data_show_all";

$sql = "CREATE TABLE $table_name_from (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  newspaper VARCHAR(255) NOT NULL,
  txt_name VARCHAR(255) NOT NULL,
  org_name VARCHAR(255) NOT NULL,
  txt_phone VARCHAR(11) NOT NULL,
  txt_email VARCHAR(55) NOT NULL,
  datepicker VARCHAR(255) NOT NULL,
  ad_title VARCHAR(255) NOT NULL,
  message VARCHAR(500) NOT NULL,
  price VARCHAR(255) NOT NULL,
  attachment VARCHAR(255) NOT NULL

)";

$wpdb->query($sql);


$table_name_insert = "wpt0_custom_from_data_show_all";

$data = array(
    'newspaper' => 'প্রথম আলো',
    'txt_name' => 'Lutfor Rhaman',
    'org_name' => 'Lrb',
    'txt_phone' => '01781973987',
    'txt_email' => 'johndoe@example.com',
    'datepicker' => '26-Feb-2023',
    'ad_title' => 'বাড়ি ভাড়া',
    'message' => 'johndoe@example.com',
    'price' => '1667',
);

$wpdb->insert( $table_name_insert, $data );


}
register_activation_hook( __FILE__, 'from_plugin_activate' );






function from_plugin_deactivation(){


global $wpdb;

$table_name_from = "wpt0_custom_from_data_show_all";

$sql = "DROP TABLE IF EXISTS $table_name_from;";

$wpdb->query($sql);

}


register_deactivation_hook(__FILE__,'from_plugin_deactivation');

