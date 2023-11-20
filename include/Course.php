<?php

class Course
{
	private $_name = "";
	private $_requirements = "";
	private $_description = "";
	private $_creatorName = "";//Would be cool to also show the creators name, we can get it from the foreign key

	function __construct($name, $requirements, $description, $creatorName)
	{
		$this->_name = $name;
		$this->_requirements = $requirements;
		$this->_description = $description;
		$this->_creatorName = $creatorName;
	}

	//Getters
	function getName()
	{
		return this->_name;
	}

	function getRequirements()
	{
		return this->_requirements;
	}

	function getDescription()
	{
		return this->_description;
	}

	function getCreatorName()
	{
		return this->_creatorName;
	}
}