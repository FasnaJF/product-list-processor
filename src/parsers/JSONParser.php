<?php

namespace src\parsers;

use src\exceptions\ParserException;
use src\interfaces\FileParserProvider;

class JSONParser extends BaseParser implements FileParserProvider
{
    /**
     * @throws ParserException
     */
    public function parseFile(string $inputFile): array
    {
        $fileData = file_get_contents($inputFile);
        $products = json_decode($fileData, true);
        return $this->parseFileWithoutDelimiter($products);
    }
}