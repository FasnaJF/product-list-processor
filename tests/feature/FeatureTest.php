<?php

namespace tests\unit;

use Exception;
use PHPUnit\Framework\TestCase;
use src\exceptions\ParserException;
use src\ProductListProcessor;

require_once realpath("vendor/autoload.php");

class FeatureTest extends TestCase
{
    /**
     * @throws ParserException
     */
    public function testParsingCSVFile()
    {
        $arguments = ['parser.php', '--file', 'products.csv', '--unique-combinations=unique_combinations.csv'];
        $productListProcessor = new ProductListProcessor();
        $this->assertTrue($productListProcessor->initiate($arguments));

    }

//    public function testParsingCSVFileWithPrintOutput()
//    {
//        $arguments = ['parser.php', '--file', 'products.csv', '--unique-combinations=unique_combinations.csv', '--print_output=true'];
//        $productListProcessor = new ProductListProcessor();
//        try {
//            $processed = $productListProcessor->initiate($arguments);
//            $this->assertTrue($processed);
//        } catch (Exception $e) {
//            $this->assertEquals("Invalid number of arguments supplied.\nRequired command format is: php parser.php --file input_file_name --unique-combinations=output_file_name"
//                , $e->getmessage());
//        }
//    }

    /**
     * @throws ParserException
     */
    public function testParsingTSVFile()
    {
        $arguments = ['parser.php', '--file', 'products.tsv', '--unique-combinations=unique_combinations.csv'];
        $productListProcessor = new ProductListProcessor();
        $this->assertTrue($productListProcessor->initiate($arguments));
    }

    /**
     * @throws ParserException
     */
    public function testParsingXMLFile()
    {
        $arguments = ['parser.php', '--file', 'products.xml', '--unique-combinations=unique_combinations.csv'];
        $productListProcessor = new ProductListProcessor();
        $this->assertTrue($productListProcessor->initiate($arguments));
    }

    /**
     * @throws ParserException
     */
    public function testParsingJSONFile()
    {
        $arguments = ['parser.php', '--file', 'products.json', '--unique-combinations=unique_combinations.csv'];
        $productListProcessor = new ProductListProcessor();
        $this->assertTrue($productListProcessor->initiate($arguments));
    }
}