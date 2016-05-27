<?php

/*
 * Plugin Name: Tap Manager
 */

final class TapManager
{
    private static $instance;

    public static $dir = '';

    public static $url = '';

    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_menu_pages' ) );
    }

    public function add_menu_pages()
    {
        new TapManager_Admin_Menu();
    }

    public static function instance()
    {
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof TapManager ) ) {
            self::$instance = new TapManager;
            self::$dir = plugin_dir_path( __FILE__ );
            self::$url = plugin_dir_url( __FILE__ );
            spl_autoload_register( array( self::$instance, 'autoloader' ) );
        }
        return self::$instance;
    }

    public function autoloader( $class_name )
    {
        if( class_exists( $class_name ) ) return;

        if (false !== strpos($class_name, 'TapManager_')) {
            $class_name = str_replace('TapManager_', '', $class_name);
            $classes_dir = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
            $class_file = str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';
            if (file_exists($classes_dir . $class_file)) {
                require_once $classes_dir . $class_file;
            }
        }
    }
}

function TapManager()
{
    return TapManager::instance();
}

TapManager();