<?php

/**
* 
 * Plugin Name: Async-Defer-JS
 * Description: Add async or defer attributes to script enqueues
 * Author: Torben Jäckel
 * @param  String  $tag     The original enqueued <script src="...> tag
 * @param  String  $handle  The registered unique name of the script
 * @return String  $tag     The modified <script async|defer src="...> tag
 * */


if(!is_admin()) {
    function add_asyncdefer_attribute($tag, $handle) {
        // if the unique handle/name of the registered script has 'async' in it
        if (strpos($handle, 'async') !== false) {
            // return the tag with the async attribute
            
            if (strpos($handle, 'defer') !== false) {
                // return the tag with the defer attribute
                return str_replace( '<script ', '<script defer async ', $tag );
            }

            return str_replace( '<script ', '<script async ', $tag );
        }

        // if the unique handle/name of the registered script has 'defer' in it
        else if (strpos($handle, 'defer') !== false) {
            // return the tag with the defer attribute
            return str_replace( '<script ', '<script defer ', $tag );
        }
        // otherwise skip
        else {
            return $tag;
        }
    }
    add_filter('script_loader_tag', 'add_asyncdefer_attribute', 10, 2);
}