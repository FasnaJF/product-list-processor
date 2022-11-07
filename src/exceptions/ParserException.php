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

    public static function requiredFieldMissing(string $fieldName, $index): static
    {
        return new static("Product's $fieldName name is missing at index: $index");
    }
}