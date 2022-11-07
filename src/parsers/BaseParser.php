<?php

namespace src\parsers;

use src\exceptions\ParserException;
use src\validators\FileParserValidator;

class BaseParser
{

    /**
     * @throws ParserException
     */
    protected function parseFileWithDelimiter(string $inputFile, string $delimiter): array
    {
        $products = [];
        $lines = file($inputFile);
        $validator = new FileParserValidator();
        foreach ($lines as $index => $line) {
            if ($index !== 0) {
                $productDetails = str_getcsv($line, $delimiter);
                $validator->validateProductDetail($productDetails, $index);
                $products[] = $productDetails;
            }
        }
        return $products;
    }

    /**
     * @throws ParserException
     */
    protected function parseFileWithoutDelimiter(array $products): array
    {
        $validator = new FileParserValidator();
        $i = -1;
        foreach ($products as $product) {
            $i++;
            $validator->validateProductDetail(array_values($this->convertObjectToArray($product)), $i);
        }
        return $products;
    }

    protected function convertObjectToArray(mixed $object): array
    {
        return json_decode(json_encode(($object)), true);
    }

}