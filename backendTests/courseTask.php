<?php
class CourseTask
{

    private $_functionName = "";
    private $_functionDeclaration = "";

    private $_testCases = [];
    private $_testAnswers = [];

    function __construct($functionName, $functionDeclaration, $testCases, $testAnswers)
    {
        $this->_functionName = $functionName;
        $this->_functionDeclaration = $functionDeclaration;
        $this->_testCases = $testCases;
        $this->_testAnswers = $testAnswers;
    }

    function getFunnctionName()
    {
        return $this->_functionName;
    }
    function getFunctionDeclaration()
    {
        return $this->_functionDeclaration;
    }

    function getTestCases()
    {
        return $this->_testCases;
    }
    function getTestAnswers()
    {
        return $this->_testAnswers;
    }
}