<?php
/**
 * The sidebar containing the main widget area
 *
 * This file is called by get_sidebar() in index.php.
 * It displays the 'main-sidebar' widget area defined in functions.php.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CORES_Theme
 */

// If the sidebar is not active (no widgets), don't display anything.
if ( ! is_active_sidebar( 'main-sidebar' ) ) {
	return;
}
?>

<!-- 
    The 'sidebar-area' class is already in index.php.
    We just need to output the widgets.
    The <aside> tag is not needed here because index.php
    already provides a wrapping <aside> tag.
-->
<?php dynamic_sidebar( 'main-sidebar' ); ?>