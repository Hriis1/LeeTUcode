<?php

use PHPUnit\Framework\TestCase;


require_once __DIR__ . '\\..\\backendTests\\courseTask.php'; // Adjust the path accordingly


class courseTaskTest extends TestCase {
    public function testTask() {

        //Construction
        $functionDeclaration = "int testFunc(std::vector<int> vec, int x)";
        $testCases = ["{ 1,3,5 }, 2","{ 1,1,1 }, 2", "{ 2,2,2 }, 5" ];
        $testAnswers =[15, 9, 21];
        $task = new CourseTask($functionDeclaration, $testCases, $testAnswers);

        //Tests
        $this->assertEquals('int testFunc(std::vector<int> vec, int x)', $task->getFunctionDeclaration());
        $this->assertEquals(["{ 1,3,5 }, 2","{ 1,1,1 }, 2", "{ 2,2,2 }, 5" ], $task->getTestCases());
        $this->assertEquals([15, 9, 21], $task->getTestAnswers());
    }
}