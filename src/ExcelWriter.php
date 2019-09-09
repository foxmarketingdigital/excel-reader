<?php


    namespace Foxmarketingdigital\ExcelReader;

    use Box\Spout\Common\Exception\IOException;
    use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
    use Box\Spout\Reader\Exception\ReaderNotOpenedException;
    use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
    use Box\Spout\Writer\Exception\InvalidSheetNameException;
    use Box\Spout\Writer\Exception\WriterNotOpenedException;

    class ExcelWriter
    {
        /**
         * @var string|null
         */
        private static $BaseDir;
        /**
         * @var
         */
        private $Name;
        /**
         * @var
         */
        private $Send;
        /** DIRETÓRIOS */
        private $Folder;

        /**
         * Verifica e cria o diretório padrão de uploads no sistema!<br>
         * Sheet constructor.
         * @param string|null $BaseDir
         */
        function __construct(?string $BaseDir = null)
        {
            self::$BaseDir = ((string)$BaseDir ? $BaseDir : '../../../uploads/');
            if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
                mkdir(
                    self::$BaseDir,
                    0777
                );
            endif;
        }

        /**
         * <b>createFile</b>
         * description: Metodo usado para criar arquivos XLS através de um array multidimensional
         * @param string $fileName
         * @param array $values
         * @param string|null $Folder
         * @param array|null $columns
         * @param string|null $sheetName
         * @return bool
         * @throws IOException
         * @throws InvalidSheetNameException
         * @throws WriterNotOpenedException
         */
        public function createFile(
            string $fileName,
            array $values,
            ?string $Folder = null,
            ?array $columns = null,
            ?string $sheetName = null
        ): bool
        {
            $this->Folder = $Folder;
            $this->Name = strtolower((string)$fileName ? $fileName . ".xlsx" : "file" . date("Y-m-dHis") . ".xlsx");
            //$documentType = mb_strtoupper($documentType, "UTF-8");
            $writer = WriterEntityFactory::createXLSXWriter();

            /**
             * Verifica se a pasta é um diretório válido
             */
            $this->CheckFolder($this->Folder);

            /**
             * Abre o arquivo
             */
            $writer->openToFile(
                ($this->Folder ? self::$BaseDir . $this->Send . $this->Name : self::$BaseDir . $this->Name)
            ); // write data to a file or to a PHP stream

            /***
             * Monta o cabeçalho do Arquivo Excel.
             * Caso não seja informado o array com o nome das colunas ele irá pegar o nome das chaves do array e tornar
             * cada chave como a primeira linha do array
             */
            if (empty($columns)):
                $arrayKeys = array_keys($values[0]);
            else:
                $arrayKeys = array_keys($columns);
            endif;
            /** Adiciona cabeçalho */
            $header = WriterEntityFactory::createRowFromArray($arrayKeys);
            if (!empty($sheetName)) {
                $sheet = $writer->getCurrentSheet();
                $sheet->setName($sheetName);
            }
            /**  */
            $writer->addRow($header);
            /** @var array $singleRow : adiciona cada linha ao arquivo XLS $singleRow */
            foreach ($values as $singleRow):
                $sRow = WriterEntityFactory::createRowFromArray($singleRow);
                $writer->addRow($sRow);
            endforeach;

            $writer->close();

            return true;
        }

        /**
         * <b>CheckFolder</b>
         * Valida se a pasta é uma pasta valida, caso a pasta não exista ele cria
         * @param string $Folder
         */
        private function CheckFolder(string $Folder)
        {

            $SubFolder = explode(
                '/',
                $Folder
            );
            if (count($SubFolder) > 1):
                foreach ($SubFolder as $sub):
                    $this->CreateFolder("{$sub}");
                endforeach;
            endif;

            $this->CreateFolder("{$Folder}");

            $this->Send = "{$Folder}/";
        }
        /*
         * ***************************************
         * **********  PRIVATE METHODS  **********
         * ***************************************
         */

        /**
         * <b>CreateFolder</b>
         * Cria a pasta definida no construtor
         * @param $Folder
         */
        private function CreateFolder($Folder)
        {
            if (!file_exists(self::$BaseDir . $Folder) && !is_dir(self::$BaseDir . $Folder)):
                mkdir(
                    self::$BaseDir . $Folder,
                    0777
                );
            endif;
        }

    }