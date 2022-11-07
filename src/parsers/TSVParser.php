<?php

namespace src\parsers;

use src\exceptions\ParserException;
use src\interfaces\FileParserProvider;

class TSVParser extends BaseParser implements FileParserProvider
{
    /**
     * @throws ParserException
     */
    public function parseFile(string $inputFile): array
    {
        $delimiter = "\t";
        return $this->parseFileWithDelimiter($inputFile,$delimiter);
    }
}