<?php
class CourseTask
{

    private $_functionName = "";
    private $_functionDeclaration = "";

    private $_testCases = [];
    private $_testAnswers = [];

    private $_baseCppFile = "";

    private $_cppFile ="";

    function __construct($functionName, $functionDeclaration, $testCases, $testAnswers)
    {
        $this->_functionName = $functionName;
        $this->_functionDeclaration = $functionDeclaration;
        $this->_testCases = $testCases;
        $this->_testAnswers = $testAnswers;

        //Load the file
        $baseCppFilePath = __DIR__ . "\\..\\rec\\baseCppProgram.txt";
        $this->_baseCppFile = file_get_contents($baseCppFilePath);

        //Create the cppfile (without the func implementation)
        $this->createCppFile();
    }

    private function createCppFile()
    {
        //Load the base file
        $this->_cppFile = $this->_baseCppFile;

        //Replace the function declaration
        $this->_cppFile = str_replace("%%funDeclaration%%",$this->_functionDeclaration,$this->_cppFile);
    }

    //Getters
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

    function getBaseCppFile()
    {
        return $this->_baseCppFile;
    }

    function getCppFile()
    {
        return $this->_cppFile;
    }
}