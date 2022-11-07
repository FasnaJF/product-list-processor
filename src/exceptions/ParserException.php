<?php

namespace src\exceptions;


class ParserException extends \Exception
{
    public static function emptyInput(): static
    {
        return new static("Your input is empty.");
    }

    public static function formatNotSupported(string $fileType): static
    {
        return new static("$fileType file format is not yet supported.");
    }

    public static function requiredFieldMissing(string $fieldName, int $index): static
    {
        return new static("Product's $fieldName name is missing at index: $index");
    }

    public static function fileNotFound(): static
    {
        return new static('File not found in inputs folder. Please check the file name.');
    }

    public static function noOutputFileName(): static
    {
        return new static("Output file name is not specified.\nRequired command format is: php parser.php --file input_file_name --unique-combinations=output_file_name");
    }

    public static function notSupportedOutputFormat(): static
    {
        return new static("Output file generated in csv format only.\nRequired command format is: php parser.php --file input_file_name --unique-combinations=output_file_name");
    }

    public static function invalidInputArgumentsCount():static
    {
        return new static("Invalid number of arguments supplied.\nRequired command format is: php parser.php --file input_file_name --unique-combinations=output_file_name");
    }
}