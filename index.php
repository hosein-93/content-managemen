<?php

// include "./autoloader.php";
include './Controller/Constant.php';
include "./Module/connection.php";
// include "./Module/Tabels.php";

include "./Controller/Utility/CRUD.php";
include "./Controller/CRUD/CRUD.php";
include "./Controller/CRUD/CRUDCategorySelect.php";


use Controller\CRUD\CRUDCategorySelect;

$categorySelect = new CRUDCategorySelect;
$categorys =  $categorySelect->CRUD();
$categorysDistinct =  $categorySelect->CRUD_DISTINCT();

$category_formSelectOption = "<option value='اصلی' selected>اصلی</option>";
foreach($categorysDistinct as $key => $value){
        $category_formSelectOption .= "<option value='{$value['name']}'>{$value['name']}</option>" ;
}

// var_dump($category_formSelectOption);

include "./View/home.php";
