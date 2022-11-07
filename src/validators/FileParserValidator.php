<?php

namespace src\validators;

use src\exceptions\ParserException;

class FileParserValidator
{

    /**
     * @throws ParserException
     */
    public static function validateProductDetail($productDetails, $index): void
    {
        if (!$productDetails[0]) {
            throw ParserException::requiredFieldMissing('brand',$index);
        }
        if (!$productDetails[1]) {
            throw ParserException::requiredFieldMissing('model',$index);
        }
    }
}