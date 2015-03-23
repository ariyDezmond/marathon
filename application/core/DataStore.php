<?php



class DataStore{
	private static $_instance;

	private $data;

	private function __construct(){}

	private function __clone(){}

	public static function getInstance()
	{
		if(!self::$_instance instanceof self)
			self::$_instance = new self();
		return self::$_instance;
	}

	public function set($name,$value)
	{
		$this->data["{$name}"] = $value;
	}

	public function get($name)
	{
		return $this->data["{$name}"];
	}
}