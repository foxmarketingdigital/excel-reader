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

    /** ler linhas do arquivo retornando um array não associativo */
    /** read lines from file returning non-associative array */
    var_dump($ExcelReader->getRows());
    echo "<hr><hr>";
    /** ler linhas do arquivo retornando um array  associativo */
    /** read lines from file returning associative array */
    var_dump($ExcelReader->getRowsAssoc());

