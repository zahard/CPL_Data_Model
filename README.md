CPL_Data_Model
==============

Use own tables in Wordpress Plugins? That class will help you. 
Just few lines - and you get CRUD operations and flexibles queries 
for you tables. Saves a lot of time for Wordpress Developers

```
#!php
include('path/to/class-cpl-data-model.php' );
$products_model = new CPL_Data_Model('products_table_name');
$products = $products_model->all('date',''DESC);
```
