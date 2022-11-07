<?php

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use src\exceptions\ParserException;
use src\factories\FileParserProviderFactory;
use src\FormatInput;
use src\parsers\CSVParser;
use src\parsers\JSONParser;
use src\parsers\TSVParser;
use src\parsers\XMLParser;
use src\Product;
use src\ProductListGenerator;
use src\ProductListProcessor;
use src\UniqueProductListFileGenerator;
use src\validators\FileParserValidator;
use src\validators\InputValidator;

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
        $productListGenerator->createProducts($data);
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

    /**
     * @throws ParserException
     */
    public function testInputFileExistsValidation()
    {
        $arguments = ['parser.php', '--file', 'products.csv', '--unique-combinations=unique_combinations.csv'];
        $this->expectExceptionObject(ParserException::fileNotFound());
        InputValidator::validateInputFormat($arguments);
    }

    /**
     * @throws ParserException
     */
    public function testOutputFileNameNotSpecifiedValidation()
    {
        $arguments = ['parser.php', '--file', 'products.sv', '--unique-combinations'];
        $this->expectExceptionObject(ParserException::noOutputFileName());
        InputValidator::validateInputFormat($arguments);
    }

    /**
     * @throws ParserException
     */
    public function testOutputFileFormatNotSupportedValidation()
    {
        $arguments = ['parser.php', '--file', 'products.sv', '--unique-combinations=unique_combinations.ysv'];
        $this->expectExceptionObject(ParserException::notSupportedOutputFormat());
        InputValidator::validateInputFormat($arguments);
    }

    public function testInputFormatter()
    {
        $arguments = ['parser.php', '--file', 'products.csv', '--unique-combinations=unique_combinations.ysv'];
        $formattedArguments = FormatInput::formatInput($arguments);
        $this->assertEquals('csv', $formattedArguments['inputFileType']);
    }

    /**
     * @throws ParserException
     */
    public function testBrandNameValidation()
    {
        $this->expectExceptionObject(ParserException::requiredFieldMissing('brand',0));
        $productDetails = ['', '1720W', 'Working', 'Grade B - Good Condition', '4GB', 'Black', 'Not Applicable'];
        FileParserValidator::validateProductDetail($productDetails,0);
    }

    /**
     * @throws ParserException
     */
    public function testModelNameValidation()
    {
        $this->expectExceptionObject(ParserException::requiredFieldMissing('model',0));
        $productDetails = ['Acer', '', 'Working', 'Grade B - Good Condition', '4GB', 'Black', 'Not Applicable'];
        FileParserValidator::validateProductDetail($productDetails,0);
    }

    /**
     * @throws ParserException
     */
    public function testInputArgumentCountValidation()
    {
        $this->expectExceptionObject(ParserException::invalidInputArgumentsCount());
        $arguments = [ '--file', 'products.csv', '--unique-combinations=unique_combinations.csv'];
        (new ProductListProcessor())->initiate($arguments);
    }
}