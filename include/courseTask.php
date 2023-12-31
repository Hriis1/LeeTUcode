<?php
include_once "taskSubmition.php";

class CourseTask
{

    private $_id = -1;
    private $_name ="";
    private $_description ="";
    private $_functionName = "";
    private $_functionDeclaration = "";
    private $_testCases = [];
    private $_testAnswers = [];
    private $_course_id = -1;
    private $_difficulty = "";
    private $_baseCppFile = "";
    private $_cppFile = "";
    

    function __construct($id, $name, $description, $functionName, $functionDeclaration, $testCases, $testAnswers, $course_id, $difficulty)
    {
        $this->_id = $id;
        $this->_name = $name;
        $this->_description = $description;
        $this->_functionName = $functionName;
        $this->_functionDeclaration = $functionDeclaration;
        $this->_testCases = $testCases;
        $this->_testAnswers = $testAnswers;
        $this->_course_id = $course_id;
        $this->_difficulty = $difficulty;

        //Load the file
        $baseCppFilePath = __DIR__ . "\\..\\rec\\baseCppProgram.txt";
        $this->_baseCppFile = file_get_contents($baseCppFilePath);

        //Create the cppfile (without the func implementation)
        $this->createCppFile();
    }



    public function addSubmition($functionImplementation)
    {
        $cppFileToCompile = $this->_cppFile;
        $cppFileToCompile = str_replace("%%funcDefinition%%", $functionImplementation, $cppFileToCompile);

        //$submition = new TaskSubmition($functionImplementation, false);//This class should be called here (probably)?

        return $cppFileToCompile;
    }

    //Creates the cpp file only missing the function implementation
    private function createCppFile()
    {
        //Load the base file
        $this->_cppFile = $this->_baseCppFile;

        //Replace the function declaration
        $this->_cppFile = str_replace("%%funDeclaration%%", $this->_functionDeclaration, $this->_cppFile);

        //Replace the func tests
        $functests = $this->buildFuncTests();
        $this->_cppFile = str_replace("%%funcTests%%", $functests, $this->_cppFile);
    }

    private function buildFuncTests()
    {
        $funcTests = "";
        $idx = 0;
        foreach ($this->_testCases as $case) {
            $funcTests = $funcTests . "if(" . $this->_functionName . "(" . $case . ") !=" . $this->_testAnswers[$idx] . "){\n";
            $funcTests = $funcTests . 'std::cout << "Input: " << "' . $case . '" << std::endl;' . "\n";
            $funcTests = $funcTests . 'std::cout << "Your answer: " << ' . $this->_functionName . "(" . $case . ") << std::endl;\n";
            $funcTests = $funcTests . 'std::cout << "Expected answer: " << ' . $this->_testAnswers[$idx] . " << std::endl;\n";
            $funcTests = $funcTests . "return 0;\n";
            $funcTests = $funcTests . "}\n\n";
            $idx++;
        }

        return $funcTests;
    }

    //Getters
    function getId()
    {
        return $this->_id;
    }
    function getName()
    {
        return $this->_name;
    }
    function getDescription()
    {
        return $this->_description;
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
    function getCourseId()
    {
        return $this->_course_id;
    }
    function getDifficulty()
    {
        return $this->_difficulty;
    }
    function getBaseCppFile()
    {
        return htmlspecialchars($this->_baseCppFile);
    }
    function getCppFile()
    {
        return htmlspecialchars($this->_cppFile);
    }

    
}