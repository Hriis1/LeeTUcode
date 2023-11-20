<?php
include "dbHandler.php";
class Course
{
	private $_id;
	private $_name = "";
	private $_requirements = "";
	private $_description = "";
	private $_creatorID;

	//Moved this to be just a getter
	//private $_creatorName = "";//Would be cool to also show the creators name, we can get it from the foreign key

	function __construct($id, $name, $requirements, $description, $creatorID)
	{
		$this->_id = $id;
		$this->_name = $name;
		$this->_requirements = $requirements;
		$this->_description = $description;
		$this->_creatorID = $creatorID;
	}

	//Getters
	function getName()
	{
		return $this->_name;
	}

	function getRequirements()
	{
		return $this->_requirements;
	}

	function getDescription()
	{
		return $this->_description;
	}

	function getCreatorID()
	{
		return $this->_creatorID;
	}
	function getCreatorName(dbHandler $_dbHandler)
	{
		return $_dbHandler->getUserById($this->_creatorID)["username"];
	}
}
