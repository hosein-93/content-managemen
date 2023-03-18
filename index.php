<?php

// include "./autoloader.php";
include './Controller/Function.php';
include './Controller/Constant.php';
include "./Module/connection.php";
// include "./Module/Tabels.php";

include "./Controller/Utility/Utility_CRUD.php";
include "./Controller/CRUD/CRUD.php";
include "./Controller/CRUD/CRUD_SELECT.php";
include "./Controller/CRUD/CRUD_UPDATE.php";
include "./Controller/CRUD/CRUD_INSERT.php";


use Controller\Constant;
use Controller\CRUD\CRUD_SELECT;

$selectCategory = new CRUD_SELECT;
$selectCategory->set_data();
$sql = "SELECT * FROM {$selectCategory->get_table()} WHERE " . Constant::COLUMN["category"]["parent"] .  "='اصلی' ORDER BY " . Constant::COLUMN["name"] . " ASC";
$selectCategory->set_sql($sql);
$allMainCategory =  $selectCategory->SELECT();

$category_formSelectOption = "<option value='اصلی' selected>اصلی</option>";
foreach ( $allMainCategory as $key => $value ): 
        $category_formSelectOption .= "<option value='{$value["name"]}'>{$value["name"]}</option>";
endforeach;
// var_dump($allMainCategory);

include "./View/home.php";


