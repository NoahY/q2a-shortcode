<?php
        
/*              
        Plugin Name: Shortcode
        Plugin URI: https://github.com/NoahY/q2a-shortcode
        Plugin Update Check URI: https://github.com/NoahY/q2a-shortcode/raw/master/qa-plugin.php
        Plugin Description: Replace shortcode
        Plugin Version: 0.2
        Plugin Date: 2012-02-28
        Plugin Author: NoahY
        Plugin Author URI:                              
        Plugin License: GPLv2                           
        Plugin Minimum Question2Answer Version: 1.3
*/        
                        
        if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
                        header('Location: ../../');
                        exit;   
        }               

        qa_register_plugin_module('module', 'qa-shortcode-admin.php', 'qa_shortcode_admin', 'Shortcode Admin');
        
        qa_register_plugin_layer('qa-shortcode-layer.php', 'Shortcode Replacement Layer');
                        
                        
/*                              
        Omit PHP closing tag to help avoid accidental output
*/                              
                          

