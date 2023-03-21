<?php

include './Constant.php';
include '../autoLoader.php';
include "../Module/connection.php";
include './Utility/Utility_CRUD.php';
include "./CRUD/CRUD.php";
include "./CRUD/CRUD_SELECT.php";

use Controller\Constant;
use Controller\CRUD\CRUD_SELECT;

parse_str($_REQUEST["data"], $formInformation);

if ($formInformation["form"] !== "Exporter") {
        echo "نام فرم دستکاری شده است!";
        return false;
}

if (!$formInformation["Type"]) {
        echo "یک نوع خروجی را انتخاب کنید!";
        return false;
}

$allCategory = new CRUD_SELECT;
$allCategory->set_data(["table" => Constant::TABEL["category"]]);
$sql_allCategory = "SELECT * FROM {$allCategory->get_table()} ORDER BY " . Constant::COLUMN["name"] . " ASC";
$allCategory->set_sql($sql_allCategory);
$allCategoryDetailes =  $allCategory->SELECT();

$allContent = new CRUD_SELECT;
$allContent->set_data(["table" => Constant::TABEL["site"]]);
$result = [];
foreach ($allCategoryDetailes as $Ckey => $Cvalue) :
        $sql_allContent = "SELECT * FROM {$allContent->get_table()} WHERE " . Constant::COLUMN["site"]["cat_id"] . "='{$Cvalue["id"]}' ORDER BY " . Constant::COLUMN["name"] . " ASC";
        $allContent->set_sql($sql_allContent);
        $allContentDetailes =  $allContent->SELECT();
        $result[$Cvalue["name"]]["create"] = $Cvalue["create_at"];
        $result[$Cvalue["name"]]["update"] = $Cvalue["update_at"];
        foreach($allContentDetailes as $key => $value) {
                $result[$Cvalue["name"]][$key] = ["name"=>$value["name"], "user"=>$value["username"], "pass"=>$value["password"], "des"=>$value["description"], "create"=>$value["create_at"], "update"=>$value["update_at"]];
        }
endforeach;

include "./Exporter/Exporter" . $formInformation['Type'] . ".php";

$className = 'Controller\Exporter\Exporter' . $formInformation['Type'];
if (class_exists($className)) {
        $createFile = new $className;
        $createFile->set_data($result);
        $createFile->export();
}
// var_dump($createFile->get_data());
