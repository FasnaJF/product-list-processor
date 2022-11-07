<?php

namespace src\factories;

use src\exceptions\ParserException;
use src\interfaces\FileParserProvider;
use src\parsers\CSVParser;
use src\parsers\TSVParser;
use src\parsers\XMLParser;
use src\parsers\JSONParser;

class FileParserProviderFactory
{
    /**
     * @throws ParserException
     */
    public static function createFileParser(string $fileType): FileParserProvider
    {
        if ($fileType == 'csv') {
            return new CSVParser();
        } elseif ($fileType == 'tsv') {
            return new TSVParser();
        } elseif ($fileType == 'json') {
            return new JSONParser();
        } elseif ($fileType == 'xml') {
            return new XMLParser();
        } else {
            throw ParserException::formatNotSupported($fileType);
        }
    }
}