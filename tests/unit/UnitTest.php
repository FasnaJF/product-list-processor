<?php

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use src\exceptions\ParserException;
use src\factories\FileParserProviderFactory;
use src\parsers\CSVParser;
use src\parsers\JSONParser;
use src\parsers\TSVParser;
use src\parsers\XMLParser;
use src\Product;
use src\ProductListGenerator;
use src\UniqueProductListFileGenerator;
use src\validators\FileParserValidator;

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
        $this->assertEquals($expectedOutput, $product->__toString());
    }

    public function testCanInitiateProductListGeneratorClass()
    {
        $productListGenerator = new ProductListGenerator();
        $this->assertInstanceOf('src\ProductListGenerator', $productListGenerator);
    }

    /**
     * @throws ParserException
     */
    public function testCreateProductsMethod()
    {
        $data = ["0" => ['ABOOK', '1720W', 'Working', 'Grade B - Good Condition', '4GB', 'Black', 'Not Applicable']];
        $productListGenerator = new ProductListGenerator();
        $products = $productListGenerator->createProducts($data);
        $this->assertEquals('array', gettype($products));
    }

    /**
     * @throws ParserException
     */
    public function testCreateEmptyProductFromProductsArray()
    {
        $this->expectExceptionObject(ParserException::emptyInput());
        $data = [];
        $productListGenerator = new ProductListGenerator();
        $products = $productListGenerator->createProducts($data);
    }

    /**
     * @throws ParserException
     */
    public function testCreateSingleProductFromProductsArray()
    {
        $data = ["0" => ['ABOOK', '1720W', 'Working', 'Grade B - Good Condition', '4GB', 'Black', 'Not Applicable']];
        $productListGenerator = new ProductListGenerator();
        $products = $productListGenerator->createProducts($data);
        $this->assertEquals('Black', $products[0]->colour);
        $this->assertEquals('1720W', $products[0]->model);
    }

    /**
     *
     * @throws ParserException
     */
    public function testCreateMultipleProductFromProductsArray()
    {
        $data = [
            "0" =>
                ['ABOOK', '1720W', 'Working', 'Grade B - Good Condition', '4GB', 'Black', 'Not Applicable'],
            "1" =>
                [
                    'ACCESSORIZE',
                    'UNIVERSAL 10 INCH TABLET FOLIO CASE - BIRDS BLACK',
                    'Brand New',
                    'Brand New',
                    'Not Applicable',
                    'Multicolour',
                    'Not Applicable'
                ]
        ];
        $productListGenerator = new ProductListGenerator();
        $products = $productListGenerator->createProducts($data);
        foreach ($products as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }

    public function testCanInitiateUniqueProductListFileGeneratorClass()
    {
        $uniqueProductListFileGenerator = new UniqueProductListFileGenerator();
        $this->assertInstanceOf('src\UniqueProductListFileGenerator', $uniqueProductListFileGenerator);
    }

    public function testCanInitiateFileParserValidatorClass()
    {
        $fileParserValidator = new FileParserValidator();
        $this->assertInstanceOf('src\validators\FileParserValidator', $fileParserValidator);
    }

    public function testCanInitiateCSVParserClass()
    {
        $csvParser = new CSVParser();
        $this->assertInstanceOf('src\parsers\CSVParser', $csvParser);
    }

    public function testCanInitiateTSVParserClass()
    {
        $tsvParser = new TSVParser();
        $this->assertInstanceOf('src\parsers\TSVParser', $tsvParser);
    }

    public function testCanInitiateXMLParserClass()
    {
        $xmlParser = new XMLParser();
        $this->assertInstanceOf('src\parsers\XMLParser', $xmlParser);
    }

    public function testCanInitiateJSONParserClass()
    {
        $jsonParser = new JSONParser();
        $this->assertInstanceOf('src\parsers\JSONParser', $jsonParser);
    }


    /**
     * @throws ParserException
     */
    public function testFileParserForCSVFile()
    {
        $fileType = 'csv';
        $parser = FileParserProviderFactory::createFileParser($fileType);
        $this->assertInstanceOf('src\parsers\CSVParser', $parser);
    }

    /**
     * @throws ParserException
     */
    public function testFileParserForTSVFile()
    {
        $fileType = 'tsv';
        $parser = FileParserProviderFactory::createFileParser($fileType);
        $this->assertInstanceOf('src\parsers\TSVParser', $parser);
    }

    /**
     * @throws ParserException
     */
    public function testFileParserForXMLFile()
    {
        $fileType = 'xml';
        $parser = FileParserProviderFactory::createFileParser($fileType);
        $this->assertInstanceOf('src\parsers\XMLParser', $parser);
    }

    /**
     * @throws ParserException
     */
    public function testFileParserForJSONFile()
    {
        $fileType = 'json';
        $parser = FileParserProviderFactory::createFileParser($fileType);
        $this->assertInstanceOf('src\parsers\JSONParser', $parser);
    }

    /**
     * @throws ParserException
     */
    public function testFileParserForInvalidFileTypes()
    {
        $fileType = 'docx';
        $this->expectExceptionObject(ParserException::formatNotSupported($fileType));
        FileParserProviderFactory::createFileParser($fileType);
    }
}