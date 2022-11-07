<?php

namespace src\parsers;

use src\exceptions\ParserException;
use src\interfaces\FileParser;

class XMLParser extends BaseParser implements FileParser
{
    /**
     * @throws ParserException
     */
    public function parseFile(string $inputFile): array
    {
        $products = ($this->convertObjectToArray(simplexml_load_file($inputFile)))['product'];
        return $this->parseFileWithoutDelimiter($products);
    }
}