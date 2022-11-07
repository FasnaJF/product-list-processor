<?php

namespace src;

class FormatInput
{
    public static function formatInput(array $arguments): array
    {
        $inputFileName = $arguments[2];
        $outputFileName = explode('=', $arguments[3])[1];

        return [
            'inputFilePath' => getcwd() . '/inputs/' . $inputFileName,
            'inputFileType' => explode('.', $inputFileName)[1],
            'outputFilePath' => getcwd() . '/outputs/' . $outputFileName,
            'toPrint' => $arguments[4] ?? false
        ];
    }


}