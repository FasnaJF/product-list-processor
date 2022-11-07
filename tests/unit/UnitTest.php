<?php

namespace tests\unit;

use Exception;
use PHPUnit\Framework\TestCase;
use src\Product;
use src\ProductListGenerator;
use src\UniqueProductListFileGenerator;

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
     * @throws Exception
     */
    public function testCreateProductsMethod()
    {
        $data = ["0" => ['ABOOK', '1720W', 'Working', 'Grade B - Good Condition', '4GB', 'Black', 'Not Applicable']];
        $productListGenerator = new ProductListGenerator();
        $products = $productListGenerator->createProducts($data);
        $this->assertEquals('array', gettype($products));
    }

    /**
     * @throws Exception
     */
    public function testCreateEmptyProductFromProductsArray()
    {
        try {
            $data = [];
            $productListGenerator = new ProductListGenerator();
            $products = $productListGenerator->createProducts($data);
            $this->fail("Expected Exception has not been raised.");
        } catch (Exception $e) {
            $this->assertEquals('Your input is empty.', $e->getmessage());
        }
    }

    /**
     * @throws Exception
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
     * @throws Exception
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
}