<?php
include('path/to/class-cpl-data-model.php' );
$products_model = new CPL_Data_Model('products_table_name');
$products = $products_model->all('date',''DESC);
