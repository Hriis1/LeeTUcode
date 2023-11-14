<?php
class CourseTask{
    private $_functionDeclaration ="";

    private $_testCases = [];
    private $_testAnswers =[];

    function __construct($functionDeclaration, $testCases, $testAnswers) {
        $this->_functionDeclaration = $functionDeclaration;
        $this->_testCases = $testCases;
        $this->_testAnswers = $testAnswers;
    }

    function getFunctionDeclaration() {
        return $this->_functionDeclaration;
    }

    function getTestCases() {
        return $this->_testCases;
    }
    function getTestAnswers() {
        return $this->_testAnswers;
    }
}