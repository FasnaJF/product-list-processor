<?php

namespace src\validators;

use src\exceptions\ParserException;

class FileParserValidator
{

    /**
     * @throws ParserException
     */
    public function validateProductDetailRows($productDetails, $index): void
    {
        if (!$productDetails[0]) {
            $lineNo = $index + 1;
            throw ParserException::requiredFieldMissing('brand',$lineNo);
        }
        if (!$productDetails[1]) {
            $lineNo = $index + 1;
            throw ParserException::requiredFieldMissing('model',$lineNo);
        }
    }

    /**
     * @throws ParserException
     */
    public function validateProductDetailNodes($productDetails, $node): void
    {
        $productDetails = array_values($productDetails);
        if (!$productDetails[0]) {
            throw ParserException::requiredFieldMissing('brand',$node);
        }
        if (!$productDetails[1]) {
            throw ParserException::requiredFieldMissing('model',$node);
        }
    }
}