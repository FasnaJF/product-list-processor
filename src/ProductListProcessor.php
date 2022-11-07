<?php

namespace src;

use src\exceptions\ParserException;
use src\factories\FileParserProviderFactory;
use src\validators\InputValidator;

class ProductListProcessor
{
    /**
     * @throws ParserException
     */
    public function initiate(array $arguments): bool
    {
        if (count($arguments) < 4) {
            throw ParserException::invalidInputArgumentsCount();
        }

        InputValidator::validateInputFormat($arguments);
        $formattedArguments = FormatInput::formatInput($arguments);
        $this->processData($formattedArguments['inputFilePath'], $formattedArguments['inputFileType'],
            $formattedArguments['outputFilePath'], $formattedArguments['toPrint']);
        return true;
    }

    /**
     * @throws ParserException
     */
    protected function processData(
        string $inputFileName,
        string $inputFileType,
        string $outputFileName,
        bool $toPrint = false
    ): bool {
        $parser = FileParserProviderFactory::createFileParser($inputFileType);
        $parserResults = $parser->parseFile($inputFileName);

        $productListGenerator = new ProductListGenerator();
        $products = $productListGenerator->createProducts($parserResults);

        $uniqueProductFileGenerator = new UniqueProductListFileGenerator();
        $uniqueProductFileGenerator->createCombinationCSV($products, $outputFileName);

        // @codeCoverageIgnoreStart
        if ($toPrint) {
            Product::printList($products);
        }
        // @codeCoverageIgnoreEnd
        return true;
    }
}