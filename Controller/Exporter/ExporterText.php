<?php

namespace Controller\Exporter;

use Controller\Exporter\Exporter;

final class ExporterText extends Exporter
{
        public function export()
        {
                $className = str_replace(__NAMESPACE__ . "\\", "", __CLASS__);
                $filePath =  $this->folderPath . "{$className}.txt";
                $content = '';
                foreach ($this->data as $Ckey => $Cvalue) {
                        $content .= "category name : {$Ckey} \t create : {$Cvalue["create"]} " . " (" . verta($Cvalue["create"]) . ")" . " \t update: {$Cvalue["update"]} " . " (" . verta($Cvalue["update"]) . ") \n";
                        foreach ($Cvalue as $key => $value) {
                                if (is_array($value)) {
                                        $name = empty($value["name"]) ? "---" : $value["name"];
                                        $user = empty($value["user"]) ? "---" : $value["user"];
                                        $pass = empty($value["pass"]) ? "---" : $value["pass"];
                                        $des = empty($value["description"]) ? "---" : $value["description"];
                                        $create = empty($value["create"]) ? "---" : $value["create"] . " (" . verta($value["create"]) . ")";
                                        $update = empty($value["update"]) ? "---" : $value["update"] . " (" . verta($value["update"]) . ")";
                                        $content .= "name : {$name} \t username : {$user} \t password : {$pass} \t description : {$des} \t create : {$create} \t update : {$update} \n";
                                }
                        }
                        $content .= "\n\n";
                }
                is_dir($this->folderPath) ? true : mkdir($this->folderPath, 0777, false);
                file_put_contents($filePath, $content . PHP_EOL, FILE_USE_INCLUDE_PATH);
                // file_put_contents($filePath, $content . PHP_EOL, FILE_APPEND);

                $this->downloaded($filePath);   // دانلود فایل ایجاد شده به وسیله پنجره ذخیره فایل
        }
}
