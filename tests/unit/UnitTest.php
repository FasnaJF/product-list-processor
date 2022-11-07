<?php

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use src\Product;

class UnitTest extends TestCase
{
    public function testCanInitiateProductClass()
    {
        $product = new Product('Acer', '4551-P322G25MSKN', 'Silver', '2GB', 'Not Applicable', 'Unknown', 'Non-working');
        $this->assertInstanceOf('src\Product', $product);
    }

    public function testProductProperties()
    {
        $product = new Product('Acer', '4551-P322G25MSKN', 'Silver', '2GB', 'Not Applicable', 'Unknown', 'Non-working');
        $this->assertEquals('Acer', $product->make);
        $this->assertInstanceOf('src\Product', $product);
    }

    public function testOutputPrintFormat()
    {
        $product = new Product('Acer', '4551-P322G25MSKN', 'Silver', '2GB', 'Not Applicable', 'Unknown', 'Non-working');
        $expectedOutput = "
                make: Acer, 
                model: 4551-P322G25MSKN, 
                colour: Silver, 
                capacity: 2GB, 
                network: Not Applicable, 
                grade: Unknown, 
                condition: Non-working
                ";
        $this->assertEquals($expectedOutput,$product->__toString());
    }
}