<?php

use PHPUnit\Framework\TestCase;


require_once 'C:\Apps\xampp\htdocs\LeeTUcode\LeeTUcode\testcases\testClass.php'; // Adjust the path accordingly

class FruitTest extends TestCase {
    public function testGetName() {
        $fruit = new Fruit('Apple', 'Red');
        $this->assertEquals('Apple', $fruit->get_name());
    }

    public function testGetColor() {
        $fruit = new Fruit('Banana', 'Yellow');
        $this->assertEquals('Yellow', $fruit->get_color());
    }
}