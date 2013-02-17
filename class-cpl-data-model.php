<?php

if( ! class_exists('CPL_Data_model') ) {

class CPL_Data_model {
	
	var $table = '';
	
	function __construct( $table ) {
		$this->table = $table;
	}
	
	function all($order_by = '',$order = 'ASC') {
		global $wpdb;
		$query = "SELECT * FROM {$this->table}";
		if( $order_by ) {
			$query .= " ORDER BY '$order_by' $order";
		}
		
		$rows = $wpdb->get_results($query);
		return $rows;
	}
	
	function get( $val, $key = 'id' ) {
		global $wpdb;
		$row = $wpdb->get_row("SELECT * FROM {$this->table} WHERE {$key} = '{$val}' LIMIT 1");
		return $row;
	}
	
	function save( $row ) {
		if( isset( $row->id ) && $row->id  ) {
			$row_in_db = $this->get( $row->id );
			if( ! empty( $row_in_db ) ) {
				return  $this->update($row);
			} else {
				return $this->insert($row);
			}
		} else {
			return $this->insert($row);
		}
	}
	
	function update( $row , $where = array() ) {
		global $wpdb;
		$row = (array) $row;
		if ( empty( $where ) ) {
			if( isset( $row['id'] ) ) {
				$where = array('id'=> $row['id']);
			}else{
				return false;
			}
		}
		unset($row['id']);
		if( empty($row) ) {
			return false;
		}
		
		return $wpdb->update( $this->table, $row , $where);
		
	}
	
	function insert( $row ) {
		global $wpdb;
		$row = (array) $row;
		unset($row['id']);
		if( empty($row) ) {
			return false;
		}
		$wpdb->insert( $this->table, $row );
		return $wpdb->insert_id; 	
	}
	
	function delete( $id ) {
		global $wpdb;
		$res = $wpdb->query("DELETE FROM {$this->table} WHERE id = '{$id}'");
		return $res;
	}
	function getEmptyRow() {
		global $wpdb;
		$row = new stdClass();
		$cols = $wpdb->get_results("SHOW COLUMNS IN {$this->table}");
		foreach( $cols as $c ) {
			$field = $c->Field;
			$row->$field = null;
		}
		return $row;
	}
	
} //End of CPL_Data_Model Class

} //Endif class_exists