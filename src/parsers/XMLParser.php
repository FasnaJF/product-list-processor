<?php

namespace src\parsers;

use src\exceptions\ParserException;
use src\interfaces\FileParserProvider;

class XMLParser extends BaseParser implements FileParserProvider
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