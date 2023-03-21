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

        public function set_data($data){
                $this->data = $data;
        }
        public function get_data(){
                return $this->data;
        }

        abstract function export();
}
