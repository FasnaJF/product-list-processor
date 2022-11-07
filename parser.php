<?php

include_once $_SERVER['PWD'] . '/autoload.php';

use src\ProductListProcessor;

$processor = new ProductListProcessor();
try {
    $processor->initiate($argv);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}