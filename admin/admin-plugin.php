<?php

class Admin_PLUGIN{


    public function __construct()
    {
        
        add_action( 'admin_menu', array( $this, 'PLUGIN_admin_menu' ) );
        add_action("admin_enqueue_scripts",array($this,"plugin_name_admin_enqueue_scripts"));

    }
    public function plugin_name_admin_enqueue_scripts(){
        $valid_page = array('from-lead');
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
        if(in_array($page,$valid_page)){

            wp_enqueue_style( "admin-from-plugin-style",plugin_dir_url(__FILE__).'assets/css/admin-plugin-style.css', false,PLUGIN_VERSION, 'all' );
       
        }
    }
    public function PLUGIN_admin_menu() {
		add_menu_page( "From Lead", "From Lead", "manage_options", "from-lead", array($this,"PLUGIN_add_menu_page_function"));
	}

    public function PLUGIN_add_menu_page_function(){

        global $wpdb;
        $table_name = "wpt0_custom_from_data_show_all";
        $results = $wpdb->get_results("SELECT * FROM $table_name");
    
      

        if ( isset( $_POST['my_action'] ) && $_POST['my_action'] == 'delete_row' ) {
            $row_id = sanitize_text_field( $_POST['row_id'] );
            $wpdb->delete(
               'wpt0_custom_from_data_show_all',
               array(
                  'id' => $row_id,
               ),
               array(
                  '%d',
               )
            );
            echo '<div class="notice notice-success is-dismissible"><p>Row deleted successfully.</p></div>';
         }
      

        ob_start();
    

        ?>
        <style>
            .td-from tr td {
                padding: 8px;
            }
            .td-from {
                margin-top: 30px;
            }
            table.td-from tbody tr td {
                padding: 8px!important;
                width: 8%!important;
                text-align: center;
            }
            .heading-from{
                text-align: center;
            }
        </style>
        <h3 style="text-align:center;">Shortcode : [from-submit-short-code]</h3>
        <h1 class="heading-from">ALL From Submiton Data</h1>
        <table class="td-from" border="1">
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Newspaper</th>
            <th scope="col">Name</th>
            <th scope="col">Org name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Date</th>
            <th scope="col">Ads title</th>
            <th scope="col">Message</th>
            <th scope="col">Price</th>
            <th scope="col">File</th>
            <th scope="col">Action</th>
            </tr>
            <?php foreach($results as $row):?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->newspaper; ?></td>
                <td><?php echo $row->txt_name; ?></td>
                <td><?php echo $row->org_name; ?></td>
                <td><?php echo $row->txt_phone; ?></td>
                <td><?php echo $row->txt_email; ?></td>
                <td><?php echo $row->datepicker; ?></td>
                <td><?php echo $row->ad_title; ?></td>
                <td><?php echo $row->message; ?></td>
                <td><?php echo $row->price; ?></td>
                <td><?php  if ( ! empty( $row->attachment ) ) {
            echo '<img src="' . $row->attachment . '" alt="' . $row->attachment . '">';
         } ?></td>
        
        <td>
           <?php
           
           echo '<form method="post">';
            echo '<input type="hidden" name="my_action" value="delete_row">';
            echo '<input type="hidden" name="row_id" value="' . $row->id . '">';
            echo '<input id="d-btn" type="submit" name="submit" value="Delete">';
            echo '</form>';
            
           ?>
            </tr>
            
            <?php endforeach; ?>
        </table>

        



        <?php

        echo ob_get_clean();

      
    }






}
new Admin_PLUGIN();
