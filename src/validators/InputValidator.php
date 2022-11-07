<?php

namespace src\validators;

use src\exceptions\ParserException;

class InputValidator
{
    /**
     * @throws ParserException
     */
    public static function validateInputFormat(array $arguments): void
    {
        $inputFileName = $arguments[2];
        if (!file_exists(getcwd() . '/inputs/' . $inputFileName)) {
            throw ParserException::fileNotFound();
        }
        if (!str_contains($arguments[3], '=')) {
            throw ParserException::noOutputFileName();
        }
        $outputFileName = explode('=', $arguments[3])[1];
        if (!str_ends_with($outputFileName, '.csv')) {
            throw ParserException::notSupportedOutputFormat();
        }
    }
}