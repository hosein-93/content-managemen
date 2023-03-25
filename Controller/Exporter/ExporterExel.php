<?php

namespace Controller\Exporter;

use Controller\Exporter\Exporter;

session_start();


final class ExporterWord extends Exporter
{
        public function export()
        {
 
                $content[0] = "Content Management with phpoffice/phpword";
                foreach ($this->data as $Ckey => $Cvalue) :
                        $content[$Ckey] =[];
                        $content[$Ckey]["name"] = "category name : {$Ckey}";
                        $content[$Ckey]["create"] = "create : {$Cvalue["create"]} " . " (" . verta($Cvalue["create"]) . ")";
                        $content[$Ckey]["update"] ="update: {$Cvalue["update"]} " . " (" . verta($Cvalue["update"]) . ")";
                        foreach ($Cvalue as $key => $value) :
                                if (is_array($value)) :
                                        $name = empty($value["name"]) ? "---" : $value["name"];
                                        $user = empty($value["user"]) ? "---" : $value["user"];
                                        $pass = empty($value["pass"]) ? "---" : $value["pass"];
                                        $des = empty($value["description"]) ? "---" : $value["description"];
                                        $create = empty($value["create"]) ? "---" : $value["create"] . " (" . verta($value["create"]) . ")";
                                        $update = empty($value["update"]) ? "---" : $value["update"] . " (" . verta($value["update"]) . ")";
                                        $content[$Ckey][$key]["name"] = "name : {$name}";
                                        $content[$Ckey][$key]["user"] = "username : {$user}";
                                        $content[$Ckey][$key]["pass"] = "password : {$pass}";
                                        $content[$Ckey][$key]["discription"] = "description : {$des}";
                                        $content[$Ckey][$key]["create"] = "create : {$create}";
                                        $content[$Ckey][$key]["update"] = "update : {$update}";
                                endif;
                        endforeach;
                        // $content[$Ckey] = array_values($content[$Ckey]);
                endforeach;

                is_dir($this->folderPath) ? true : mkdir($this->folderPath, 0777, false);

                $_SESSION["ExporterWord"] = $content;
                // $_SESSION["ExporterWord"] = $this->data;
                header("location: phpword.php");
        }
}
