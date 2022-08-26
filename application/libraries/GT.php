<?php
require_once 'Grocery_CRUD.php';

class GT extends grocery_CRUD{

	private static $instance;

	public static function query($table=''){
		// Create it if it doesn't exist.
		if (!self::$instance) {
			self::$instance = new GT();
			self::$instance->set_table($table);
		}
		return self::$instance;
	}
}
