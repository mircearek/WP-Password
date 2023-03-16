<?php
/*
 * Plugin Name: SHA512 PBKDF2 Passwords
 * Author: Mircea Rechesan
 * Author URI: https://github.com/mircearek
 * Version: 2.0
*/

if( !function_exists( 'wp_hash_password' ) ) {
    function wp_hash_password( $password ) {
        $iterations = 1000;
        return hash_pbkdf2("sha512", $password, LOGGED_IN_SALT, $iterations, 0);

    }
}

if( !function_exists( 'wp_check_password' ) ) {
    function wp_check_password( $password, $hash, $user_id = '' ) {
        $plainToHash = wp_hash_password( $password );
        if ( hash_equals( $plainToHash, $hash ) ) {
            return true;
        }
        return false;
    }
}

if ( !function_exists( 'remove_week_pass_confirmation' ) ) {
    function remove_week_pass_confirmation() { ?>
        <script>
            var $ = jQuery.noConflict();
            $(document).ready(function(){
                $('.pw-weak').remove();
            });
        </script>
        <?php
    }
    //add_action('admin_head','remove_week_pass_confirmation');
}
