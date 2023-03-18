<?php

include './Constant.php';
include '../autoLoader.php';
include "../Module/connection.php";
include './Utility/CRUD.php';



parse_str($_REQUEST["data"], $formInformation);
// var_dump($_REQUEST);

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
                $classFullName = 'Controller\CRUD\\' . $formInformation["form"];
                $class = new $classFullName($formInformation);
                $result = $class->CRUD();
                var_dump($result);
                break;

        case ("CRUDCategoryEdit"):
                $classFullName = 'Controller\CRUD\\' . $formInformation["form"];
                $class = new $classFullName($formInformation);
                $result = $class->CRUD();
                var_dump($result);
                break;

        case ("CRUDCategoryDelete"):
                $classFullName = 'Controller\CRUD\\' . $formInformation["form"];
                $class = new $classFullName($formInformation);
                $result = $class->CRUD();
                var_dump($result);
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