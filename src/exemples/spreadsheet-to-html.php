<?php

    use Foxmarketingdigital\ExcelReader\ExcelReader;

    require_once __DIR__ . '/../../vendor/autoload.php';
    /** @var ExcelReader $ExcelReader : instantiate class */
    $ExcelReader = new ExcelReader();
    /** @var string $file */
    $file = __DIR__ . '/teste.xlsx';

    /** Carrega o arquivo xls/xlsx */
    /** load file xls/xlsx */
    $ExcelReader->loadFile($file);

    echo $ExcelReader->inHTML();
