<?php

namespace src\parsers;

use src\exceptions\ParserException;
use src\interfaces\FileParser;

class TSVParser extends BaseParser implements FileParser
{
    /**
     * @throws ParserException
     */
    public function parseFile(string $inputFile): array
    {
        $delimiter = "\t";
        return $this->parseFileWithDelimiter($inputFile, $delimiter);
    }
}