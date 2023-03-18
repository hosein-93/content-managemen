<?php

// include "./autoloader.php";
include './Controller/Function.php';
include './Controller/Constant.php';
include "./Module/connection.php";
// include "./Module/Tabels.php";

include "./Controller/Utility/CRUD.php";
include "./Controller/CRUD/CRUD.php";
include "./Controller/CRUD/CRUDCategorySelect.php";
include "./Controller/CRUD/CRUDCategoryEdit.php";
include "./Controller/CRUD/CRUDCategoryAdd.php";


use Controller\Constant;
use Controller\CRUD\CRUDCategorySelect;

$selectCategory = new CRUDCategorySelect;
$mainWhere = Constant::COLUMN["category"]["parent"] . "='اصلی' ORDER BY " . Constant::COLUMN["name"] . " ASC";
$allMainCategory =  $selectCategory->WHERE($mainWhere);
$distinctCategorys =  $selectCategory->DISTINCT();

$category_formSelectOption = "<option value='اصلی' selected>اصلی</option>";
foreach ($distinctCategorys as $key => $value) {
        $category_formSelectOption .= "<option value='{$value['name']}'>{$value['name']}</option>";
}

// var_dump($a);

include "./View/home.php";
