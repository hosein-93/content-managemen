<?php

include './Constant.php';
include '../autoLoader.php';
include "../Module/connection.php";
include './Utility/Utility_CRUD.php';



parse_str($_REQUEST["data"], $formInformation);
// var_dump($formInformation);
// die();

if (empty($formInformation["Name"])) {
        echo ('<p class="d-block bg-dark text-warning text-center p-3 mb-3 rounded-3">فیلدهای ستاره‌دار نمی‌توانند خالی باشند.</p>');
        die();
}

use Controller\Constant;

foreach ($formInformation as $key => $value) {
        if (!in_array($key, Constant::FORM)) {
                echo ('<p class="d-block bg-dark text-warning text-center p-3 mb-3 rounded-3">نام ورودی‌های فرم دستکاری شده است.</p>');
                die();
        }
}


switch ($formInformation["form"]):
        case ("CRUDCategoryAdd"):
                $classFullName = 'Controller\CRUD\CRUD_INSERT';
                $class = new $classFullName;
                $class->set_data($formInformation);
                $sql = "INSERT INTO {$class->get_table()} 
                        ( " . Constant::COLUMN["name"] . "," . Constant::COLUMN["category"]["parent"] . " ) 
                        VALUES ( :name, :parent )";
                $class->set_sql($sql);
                $execute = [":name" => htmlentities($formInformation["Name"]), ":parent" => htmlentities($formInformation["Parent"])];
                $class->set_execute($execute);
                $result = $class->INSERT();
                // var_dump($result);
                break;

        case ("CRUDCategoryEdit"):
                $classFullName = 'Controller\CRUD\CRUD_UPDATE';
                $class = new $classFullName;
                $class->set_data($formInformation);
                $sql = "UPDATE {$class->get_table()} SET "
                        . Constant::COLUMN["name"] . "=:name , "
                        . Constant::COLUMN["category"]["parent"] . "=:category , "
                        . Constant::COLUMN["update"] . "=:update WHERE "
                        . Constant::COLUMN["id"] . "=:id ";
                $class->set_sql($sql);
                $execute = [":name" => htmlentities($formInformation["Name"]), ":category" => htmlentities($formInformation["Parent"]), ":update" => date("Y-m-d H:i:s"), ":id" => htmlentities($formInformation["Number"])];
                $class->set_execute($execute);
                $result = $class->UPDATE();
                // var_dump($result);
                break;

        case ("CRUDCategoryDelete"):

                $classFullName = 'Controller\CRUD\CRUD_DELETE';
                $class = new $classFullName;
                $class->set_data($formInformation);
                $sql = "DELETE FROM {$class->get_table()} WHERE "
                        . Constant::COLUMN["id"] . "=:id ";
                $class->set_sql($sql);
                $execute = [":id" => htmlentities($formInformation["Number"])];
                $class->set_execute($execute);
                $result = $class->DELETE();
                // var_dump($result);
                break;

        case ("CRUDContentAdd"):
                break;

        case ("CRUDContentEdit"):
                break;

        case ("CRUDContentDelete"):
                break;

        default:
                echo '<p class="d-block bg-dark text-warning text-center p-3 mb-3 rounded-3">فرم ارسالی نامعتبر است</p>';
endswitch;
