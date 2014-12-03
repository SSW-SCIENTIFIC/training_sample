<?php

require_once(dirname(__FILE__).'/ISuperOrganizationDAO.interface.php');
require_once(dirname(__FILE__).'/SuperOrganization.class.php');

class SuperOrganizationDAO implements ISuperOrganizationDAO
{
	private $_PDOObject;
	private $_selectById;
	private $_selectAll;
	private $_insert;
	private $_update;
	private $_deleteById;
	
	public function __construct(&$PDOObject)
	{
		$this->_PDOObject = $PDOObject;
	}
	
	public function selectSuperOrganizationById($id)
	{
		if(empty($this->_selectById))
			$this->_selectById = $this->_PDOObject->prepare('SELECT * FROM superorganization WHERE superorganization.superorganization_id = :id;');
		
		$this->_selectById->bindParam(':id', $id, PDO::PARAM_INT);
		$this->_selectById->execute();
		
		$result = $this->_selectById->fetch(PDO::FETCH_ASSOC);
		return new SuperOrganization($result['superorganization_name_ja'], $result['superorganization_name_en'], $result['superorganization_id']);
	}
	
	public function selectAllSuperOrganizations()
	{
		if(empty($this->_selectAll))
			$this->_selectAll = $this->_PDOObject->prepare('SELECT * FROM superorganization;');
		
		$this->_selectAll->execute();
		
		$results = array();
		while($record = $this->_selectById->fetch(PDO::FETCH_ASSOC))
			$results[] = new SuperOrganization($record['superorganization_name_ja'], $record['superorganization_name_en'], $record['superorganization_id']);
		
		return $results;
	}
	
	public function insertSuperOrganization(&$superOrganization)
	{
		if(empty($this->_insert))
			$this->_insert = $this->_PDOObject->prepare('INSERT INTO superorganization (superorganization_name_ja, superorganization_name_en) VALUES (:name_ja, :name_en);');

		$this->_insert->bindValue(':name_ja', $superOrganization->getNameJa(), PDO::PARAM_STR);
		$this->_insert->bindValue(':name_en', $superOrganization->getNameEn(), PDO::PARAM_STR);
		$this->_insert->execute();
	}
	
	public function updateSuperOrganization(&$superOrganization)
	{
		if(empty($this->_update))
			$this->_update = $this->_PDOObject->prepare('INSERT INTO superorganization (superorganization_id, superorganization_name_ja, superorganization_name_en) VALUES (:id, :name_ja, :name_en);');

		$this->_update->bindValue(':id', $superOrganization->getId(), PDO::PARAM_INT);
		$this->_update->bindValue(':name_ja', $superOrganization->getNameJa(), PDO::PARAM_STR);
		$this->_update->bindValue(':name_en', $superOrganization->getNameEn(), PDO::PARAM_STR);
		$this->_update->execute();
	}

	public function deleteSuperOrganizationById($id)
	{
		if(empty($this->_update))
			$this->_deleteById = $this->_PDOObject->prepare('DELETE FROM superorganization WHERE superorganization.superorganization_id = :id ORDEY BY id LIMIT 1;');

		$this->_update->bindValue(':id', $superOrganization->getId(), PDO::PARAM_INT);
		$this->_update->execute();
	}
	
	public function deleteSuperOrganizationByInstance(&$superOrganization)
	{
		$record = $this->selectSuperOrganizationById($supreOrganization->getId());
		if($record != $superOrganization)
			return;

		$this->deleteSuperOrganizationById($superOrganization->getId());
	}
	
};