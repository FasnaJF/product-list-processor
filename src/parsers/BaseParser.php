<?php

namespace src\parsers;

use src\exceptions\ParserException;
use src\validators\FileParserValidator;

class BaseParser
{

    /**
     * @throws ParserException
     */
    protected function parseFileWithDelimiter($inputFile, $delimiter): array
    {
        $products = [];
        $lines = file($inputFile);
        $validator = new FileParserValidator();
        foreach ($lines as $index => $line) {
            if ($index !== 0) {
                $productDetails = str_getcsv($line, $delimiter);
                $validator->validateProductDetailRows($productDetails, $index);
                $products[] = $productDetails;
            }
        }
        return $products;
    }

    /**
     * @throws ParserException
     */
    protected function parseFileWithoutDelimiter($products): array
    {
        $validator = new FileParserValidator();
        $i = -1;
        foreach ($products as $product) {
            $i++;
            $validator->validateProductDetailNodes($this->convertObjectToArray($product), $i);
        }
        return $products;
    }

    protected function convertObjectToArray($object)
    {
        return json_decode(json_encode(($object)), true);
    }

}