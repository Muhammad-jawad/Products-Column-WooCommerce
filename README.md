=== Add Product Column === 
Contributors: jawadarshad
Donate link: https://jawadarshad.io/
Tags: add product column in order email, woocommerce order email, add text before order table, order table, woocommerce_email_before_order_table

This is the code to add columns before order table in order email woocommerce by using woocommerce_email_before_order_table action.

== Installation ==

1. Add this code in your function.php
	// Adding products top of order email
	include_once( get_stylesheet_directory() .'order_meta_column.php'); 
2. create one file called order_meta_column.php
3. Copy and paste this code into that file