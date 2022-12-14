<?php

namespace src\factories;

use src\exceptions\ParserException;
use src\interfaces\FileParser;
use src\parsers\CSVParser;
use src\parsers\TSVParser;
use src\parsers\XMLParser;
use src\parsers\JSONParser;

class FileParserProviderFactory
{
    /**
     * @throws ParserException
     */
    public static function createFileParser(string $fileType): FileParser
    {
        return match ($fileType) {
            'csv' => new CSVParser(),
            'tsv' => new TSVParser(),
            'xml' => new XMLParser(),
            'json' => new JSONParser(),
            default => throw ParserException::formatNotSupported($fileType),
        };
    }
}