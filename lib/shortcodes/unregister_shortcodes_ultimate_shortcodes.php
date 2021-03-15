<?php
add_filter( 'su/data/shortcodes', 'remove_su_shortcodes' );

/**
 * Filter to modify original shortcodes data
 *
 * @param array   $shortcodes Default shortcodes
 * @return array Modified array
 */
function remove_su_shortcodes( $shortcodes ) {

    // Remove all shortcodes
    $shortcodes = array();

    // Return modified data
    return $shortcodes;

}