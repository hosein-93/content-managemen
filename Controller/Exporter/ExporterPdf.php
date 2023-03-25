<?php

namespace Controller\Exporter;

use Controller\Exporter\Exporter;

session_start();


final class ExporterPdf extends Exporter
{
        public function export()
        {
                $content = '';
                foreach ($this->data as $Ckey => $Cvalue) {
                        $content .= "<br><br>category name : {$Ckey}<br>create : {$Cvalue["create"]} " . " (" . verta($Cvalue["create"]) . ")" . "<br>update: {$Cvalue["update"]} " . " (" . verta($Cvalue["update"]) . ") <br><br>Content detailes : <br>";
                        foreach ($Cvalue as $key => $value) {
                                if (is_array($value)) {
                                        $name = empty($value["name"]) ? "---" : $value["name"];
                                        $user = empty($value["user"]) ? "---" : $value["user"];
                                        $pass = empty($value["pass"]) ? "---" : $value["pass"];
                                        $des = empty($value["description"]) ? "---" : $value["description"];
                                        $create = empty($value["create"]) ? "---" : $value["create"] . " (" . verta($value["create"]) . ")";
                                        $update = empty($value["update"]) ? "---" : $value["update"] . " (" . verta($value["update"]) . ")";
                                        $content .= "name : {$name}<br>username : {$user}<br>password : {$pass}<br>description : {$des}<br>create : {$create}<br>update : {$update} <br><br>";
                                }
                        }
                        $content .= '<hr> <span style="color: #ffffff;">.</span>';
                }
                
                $_SESSION["ExporterPdf"] = $content;
                header("location: tcpdf.php");
        }
}
