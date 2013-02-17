<?php
//Include Library
include('path/to/class-cpl-data-model.php' );

//Setting up your table name
global $wpdb;
$table_name = $wpdb->prefix . 'products_table';

//Create Model for your Table
$products_model = new CPL_Data_Model( $table_name, 'ID' ); # Choose primary key field

//Get all your products ( "SELECT * FROM `TABLE_NAME`" )
$products = $products_model->all();

//Create New Product 
$product = array(
  'name' => 'Product Name',
  'category' => 123,
  'vendor' => 'Vendor Name'
);
//Save method reutrn ID for insered or updated item
$product_id = $products_model->save( $product );

//Deleta Product
$products_model->delete( $product_id );
