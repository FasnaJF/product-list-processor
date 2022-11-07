<?php

namespace src\interfaces;

interface FileParserProvider
{
    public function parseFile(string $inputFile);
}
