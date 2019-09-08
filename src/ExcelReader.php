<?php


    namespace Foxmarketingdigital\ExcelReader;


    use SimpleXLSX;

    /**
     * Class ExcelReader
     * @package Foxmarketingdigital\ExcelReader
     */
    class ExcelReader extends SimpleXLSX
    {
        /**
         * @var
         */
        private $file;

        public function __construct()
        {
            parent::__construct();
        }

        /**
         * <b>loadFile:</b>:
         * port: Passe o caminho absoluto do arquivo, caso seja um arquivo válido ele retorna true, caso contrário retorna false
         * eng: Pass the absolute path of the file, if it is a valid file it returns true, otherwise false
         * @param string $file
         * @return bool
         */
        public function loadFile(string $file): bool
        {

            if (parent::parse($file)) {
                $this->file = parent::parse($file);
                return true;
            } else {
                return parent::parseError();
            }
        }

        /**
         * <b>getRows</b>:
         * port: Lê as linhas do arquivo e retorna um objeto com as linhas em um array atributivo
         * @param int|null $sheetIndex
         * @return false|object|string
         */
        public function getRows(?int $sheetIndex = 0)
        {
            if (empty($this->file)) {
                return $this->errorLoadFile();
            } else {

                return $this->file->rows($sheetIndex);
            }
        }

        /**
         * <b>getRowsAssoc</b>:
         * port: Retorna um array associativo
         * eng: Returns an associative array
         * @param int|null $sheetIndex
         * @return array|false|string
         */
        public function getRowsAssoc(?int $sheetIndex = 0)
        {
            if (empty($this->file)) {
                return $this->errorLoadFile();
            } else {
                $rows = $this->file->rows($sheetIndex);
                $keys = $rows[0];
                unset($rows[0]);
                foreach ($rows as $row) {
                    $j[] = array_combine($keys, $row);
                }
                return $j;
            }
        }

        /**
         * <b>inHTML</b>: imprime a planilha excel em html
         * @return false|string
         */
        public function inHTML()
        {
            if (empty($this->file)) {
                return $this->errorLoadFile();
            } else {
                return $this->file->toHTML(0);
            }
        }

        public function getCell($worksheetIndex = 0, $cell = 'A1')
        {
            if (empty($this->file)) {
                return $this->errorLoadFile();
            } else {
                return $this->file->getCell($worksheetIndex, $cell); // TODO: Change the autogenerated stub
            }

        }

        /**
         * <b>sheetNames</b>
         * port: Recupera os nomes das planilhas
         * @return array|false|string
         */
        public function sheetNames()
        {
            if (empty($this->file)) {
                return $this->errorLoadFile();
            } else {
                return $this->file->sheetNames();
            }

        }

        /**
         * <b>errorLoadFile:</b> retorna mensagem de erro
         * @return false|string
         */
        private function errorLoadFile()
        {
            $j["Error"] = [
                "message" => "you need to load a file before trying to read the file lines, use the loadFile method and pass the absolute file path"
            ];
            return json_encode($j);
        }
    }