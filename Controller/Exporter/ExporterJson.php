<?php

namespace Controller\Exporter;

use Controller\Exporter\Exporter;

final class ExporterJson extends Exporter
{
        public function export()
        {
                $className = str_replace(__NAMESPACE__ . "\\", "", __CLASS__);
                $filePath =  $this->folderPath . "{$className}.json";
                $content = json_encode($this->data);
                is_dir($this->folderPath) ? true : mkdir($this->folderPath, 0777, false);
                file_put_contents($filePath, $content . PHP_EOL, FILE_USE_INCLUDE_PATH);
                // file_put_contents($filePath, $content . PHP_EOL, FILE_APPEND);
        }
}
