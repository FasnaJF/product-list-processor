<?php

namespace src\parsers;

use src\exceptions\ParserException;
use src\interfaces\FileParserProvider;

class CSVParser extends BaseParser implements FileParserProvider
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