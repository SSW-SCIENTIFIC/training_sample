<?php

require_once(dirname(__FILE__).'/ISuperOrganization.interface.php');

class SuperOrganization implements ISuperOrganization 
{
	private $_id;
	private $_name_ja;
	private $_name_en;
	
	public function __construct($name_ja, $name_en, $id = null)
	{
		$this->_name_ja = $name_ja;
		$this->_name_en = $name_en;
		$this->_id = isset($id) ? intval($id) : null;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function setId($id)
	{
		$temp_id = $this->_id;
		$this->_id = is_null($id) ? null : intval($id);
		
		return $temp_id;
	}
	
	public function getNameJa()
	{
		return $this->_name_ja;
	}

	public function setNameJa($name_ja)
	{
		$temp_name = $this->_name_ja;
		$this->_name_ja = is_string($name_ja) ? string($name_ja) : '';
		
		return $temp_name;
	}

	public function getNameEn()
	{
		return $this->_name_en;
	}

	public function setNameEn($name_en)
	{
		$temp_name = $this->_name_en;
		$this->_name_en = is_string($name_en) ? string($name_en) : '';
		
		return $temp_name;
	}


};