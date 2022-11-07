<?php

namespace src\parsers;

use src\exceptions\ParserException;
use src\interfaces\FileParser;

class CSVParser extends BaseParser implements FileParser
{
    /**
     * @throws ParserException
     */
    public function parseFile(string $inputFile): array
    {
        $delimiter = ',';
        return $this->parseFileWithDelimiter($inputFile, $delimiter);
    }
}