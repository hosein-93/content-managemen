<?php

namespace Controller\Exporter;

use Controller\Constant;

interface Exportebale
{
        public function export();
}

abstract class Exporter implements Exportebale
{
        protected $data;
        protected $folderPath = Constant::URL_PATH . '/ExporterFile/';
        protected $fileUrl = Constant::URL . "/ExporterFile/";

        public function set_data($data)
        {
                $this->data = $data;
        }
        public function get_data()
        {
                return $this->data;
        }

        abstract function export();

        protected function downloaded($path)
        {
                //Define header information
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header("Content-Transfer-Encoding: Binary");
                header("Cache-Control: no-cache, must-revalidate");
                header("Expires: 0");
                header('Content-Disposition: attachment; filename="' . basename($path) . '"');
                header('Content-Length: ' . filesize($path));
                header('Pragma: public');

                //Clear system output buffer
                flush();

                //Read the size of the file
                readfile($path);

                //Terminate from the script
                die();
        }
}
