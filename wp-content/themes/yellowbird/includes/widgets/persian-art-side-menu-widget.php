<?php 
/* ----------------------------------------

	Plugin Name: PersianArt Side Menu Widget
	Description: Show Menu in Custom Style
	Version: 1.0
	Author: PersianArt 
	Author URL: http://www.PersiTheme.com/

---------------------------------------- */

// register widget and add it
add_action( 'widgets_init', 'PersianArt_SideMenu_widget' );
function PersianArt_SideMenu_widget() {
	register_widget( 'PersianArt_SideMenu' );
}

class PersianArt_SideMenu extends WP_Nav_Menu_Widget {

	// constructor
    function PersianArt_SideMenu() {
        parent::WP_Widget(false, 'PersianArt - Side Menu', array('description' => __('Show latest comments', 'my_framework')));	
    }
}