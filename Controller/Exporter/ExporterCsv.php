<?php

namespace Controller\Exporter;

use Controller\Exporter\Exporter;

final class ExporterCsv extends Exporter
{
        public function export()
        {
                $className = str_replace(__NAMESPACE__ . "\\", "", __CLASS__);
                $filePath =  $this->folderPath . "{$className}.csv";
                $content = '';
                $content .= "category name , create category , update category , , content name , content username , content password , content description , content create , content update \n";
                foreach ($this->data as $Ckey => $Cvalue) {
                        $content .= "\n";
                        foreach ($Cvalue as $key => $value) {
                                if (is_array($value)) {
                                        $C_create = $Cvalue["create"] . " (" . verta($Cvalue["create"]) .")";
                                        $C_update = $Cvalue["update"] . " (" . verta($Cvalue["update"]) .")";
                                        $name = empty($value["name"]) ? "---" : $value["name"];
                                        $user = empty($value["user"]) ? "---" : $value["user"];
                                        $pass = empty($value["pass"]) ? "---" : $value["pass"];
                                        $des = empty($value["description"]) ? "---" : nl2br($value["description"]);
                                        $create = empty($value["create"]) ? "---" : $value["create"] . " (" . verta($value["create"]) .")";
                                        $update = empty($value["update"]) ? "---" : $value["update"] . " (" . verta($value["update"]) .")";
                                        $content .= "{$Ckey} , {$C_create} , {$C_update} , , {$name} , {$user} , {$pass} , {$des} , {$create} , {$update} \n";
                                }
                        }
                }
                is_dir($this->folderPath) ? true : mkdir($this->folderPath, 0777, false);
                file_put_contents($filePath, $content . PHP_EOL, FILE_USE_INCLUDE_PATH);
                // file_put_contents($filePath, $content . PHP_EOL, FILE_APPEND);
        }
}
