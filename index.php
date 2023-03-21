<?php

// include "./autoloader.php";
include './Controller/Constant.php';
include "./Module/connection.php";
// include "./Module/Tabels.php";

include "./Controller/Utility/Utility_CRUD.php";
include "./Controller/CRUD/CRUD.php";
include "./Controller/CRUD/CRUD_SELECT.php";

use Controller\Constant;
use Controller\CRUD\CRUD_SELECT;

$allCategory = new CRUD_SELECT;
$allCategory->set_data(["table"=>Constant::TABEL["category"]]);
$sql_allCategory = "SELECT * FROM {$allCategory->get_table()} ORDER BY " . Constant::COLUMN["name"] . " ASC";
$allCategory->set_sql($sql_allCategory);
$allCategoryDetailes =  $allCategory->SELECT();

$allContent = new CRUD_SELECT;
$allContent->set_data(["table"=>Constant::TABEL["site"]]);
$sql_allContent = "SELECT * FROM {$allContent->get_table()} ORDER BY " . Constant::COLUMN["name"] . " ASC";
$allContent->set_sql($sql_allContent);
$allContentDetailes =  $allContent->SELECT();

$allCategoryName = [];
foreach ( $allCategoryDetailes as $key => $value ) {
        $allCategoryName[$key] = $value["name"];
}
$allCategoryName = json_encode($allCategoryName);

include "./View/home.php";

