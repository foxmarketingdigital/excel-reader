# excel-reader
###### a simple class for reading xls and xlsx files
Uma biblioteca simples para leitura de arquivos xlsx e xls

### Highlights

###### English:
- Reading spreadsheet data returning a non-associative array
- Read data returning an associative (slower) array
- define which spreadsheet to read
- Print spreadsheet as html
- Read specific cell (slower)
- Composer ready and PSR-2 (Composer ready and PSR-2 compatible)
- Typing methods and error treatments

###### Português:
- Leitura de dados da planilha retornando um array não associativo
- Leitura de dados retornando um array associativo ( mais lento)
- definir qual planilha ler
- Imprimir planilha como html
- Ler celula especifica ( mais lento)
- Composer ready e PSR-2 (Pronto para o compositor e compatível com PSR-2)
 - Tipagem de métodos e tratamentos de erro
 
 ## Installation

excel-reader is available via Composer:

```bash
"foxmarketingdigital/excel-reader": "^1.0"
```

or run

```bash
composer require foxmarketingdigital/excel-reader
```
 
 ## Documentation
 
 ###### For more details on how to use the currently available methods, you can check the examples folder in the main directory.
 ###### Below you will find some basic examples of how to use

Para mais detalhes de como usar os métodos disponíveis atualmente, você pode conferir a pasta exemples no diretório principal.

Abaixo você encontrará alguns exemplos básicos de como usar

### Read file | Ler Arquivo

```bash
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

```

### XLSX to HTML | XLS para HTML

```bash
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
```
