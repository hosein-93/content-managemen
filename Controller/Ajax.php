<?php

include './Constant.php';
include '../autoLoader.php';
include "../Module/connection.php";
include './Utility/Utility_CRUD.php';
include "./CRUD/CRUD.php";

use Controller\Constant;

parse_str($_REQUEST["data"], $formInformation);
$allCategoryName = json_decode($_REQUEST["categoryNames"]);
$categoryName = $_REQUEST["categoryName"];
$targetId = $_REQUEST["targetId"];

// if (empty($formInformation["Name"])) {
//         echo ('فیلدهای ستاره‌دار نمی‌توانند خالی باشند.');
//         die();
// }

// foreach ($formInformation as $key => $value) {
//         if (!in_array($key, Constant::FORM)) {
//                 echo ('نام ورودی‌های فرم دستکاری شده است.');
//                 die();
//         }
// }


switch ($formInformation["form"]):
        case ("category-insert"):
                // برسی آنکه آیا نام جدید انتخاب شده در دسته بندی های موجود در دیتابیس نباشد
                if (in_array($formInformation["Name"], $allCategoryName)) {
                        echo ('نام دسته‌بندی ( ' . $formInformation["Name"] . ' ) مورد نظر از قبل موجود است!');
                        return false;
                }
                // --------------------------------------------------------------------
                // اضافه کردن دسته بندی جدید
                $class = new Controller\CRUD\CRUD_INSERT;
                $class->set_data(["table" => Constant::TABEL["category"]]);
                $sql = "INSERT INTO {$class->get_table()} ( " . Constant::COLUMN["name"] . " ) VALUES ( :name )";
                $class->set_sql($sql);
                $execute = [":name" => htmlentities($formInformation["Name"])];
                $class->set_execute($execute);
                $result = $class->INSERT();
                echo is_numeric($result) ? true : false;
                break;

        case ("category-update"):
                // برسی آنکه آیا نام جدید انتخاب شده در دسته بندی های موجود در دیتابیس نباشد
                if (in_array($formInformation["Name"], $allCategoryName)) {
                        echo ('دسته‌بندی ( ' . $formInformation["Name"] . ' ) از قبل موجود است!');
                        return false;
                }
                // --------------------------------------------------------------------
                // تغییر نام دسته بندی جدید
                $class = new Controller\CRUD\CRUD_UPDATE;
                $class->set_data(["table" => Constant::TABEL["category"]]);
                $sql = "UPDATE {$class->get_table()} SET "
                        . Constant::COLUMN["name"] . "=:name , "
                        . Constant::COLUMN["update"] . "=:update WHERE "
                        . Constant::COLUMN["id"] . "='{$targetId}' ";
                $class->set_sql($sql);
                $execute = [":name" => htmlentities($formInformation["Name"]), ":update" => date("Y-m-d H:i:s")];
                $class->set_execute($execute);
                $result = $class->UPDATE();
                echo $result === 1 ? true : false;
                break;

        case ("category-delete"):
                // برسی آنکه آیا نام جدید انتخاب شده در دسته بندی های موجود در دیتابیس نباشد
                if (!in_array($categoryName, $allCategoryName)) {
                        echo ('دسته‌بندی ( ' . $categoryName . ' ) موجود نیست!');
                        return false;
                }
                // --------------------------------------------------------------------

                $classContent = new Controller\CRUD\CRUD_DELETE;
                $classContent->set_data(["table" => Constant::TABEL["site"]]);
                $sqlContent = "DELETE FROM {$classContent->get_table()} WHERE "
                        . Constant::COLUMN["site"]["cat_id"] . "=:id ";
                $classContent->set_sql($sqlContent);
                $executeContent = [":id" => htmlentities($targetId)];
                $classContent->set_execute($executeContent);
                $resultContent = $classContent->DELETE();

                $class = new Controller\CRUD\CRUD_DELETE;
                $class->set_data(["table" => Constant::TABEL["category"]]);
                $sql = "DELETE FROM {$class->get_table()} WHERE "
                        . Constant::COLUMN["id"] . "=:id ";
                $class->set_sql($sql);
                $execute = [":id" => htmlentities($targetId)];
                $class->set_execute($execute);
                $result = $class->DELETE();
                echo ($result === 1) ? true : false;
                break;

        case "content-insert":
                // برسی آنکه آیا نام جدید انتخاب شده در دسته بندی های موجود در دیتابیس نباشد
                if (!in_array($categoryName, $allCategoryName)) {
                        echo ('دسته‌بندی ( ' . $categoryName . ' ) موجود نیست!');
                        return false;
                }
                // --------------------------------------------------------------------
                // برسی آنکه نام جدید انتخاب شده در محتواهای موجود در دسته‌بندی مشخص شده در دیتابیس نباشد
                $checkContent = new Controller\CRUD\CRUD_SELECT;
                $checkContent->set_data(["table" => Constant::TABEL["site"]]);
                $check = "SELECT " . Constant::COLUMN["name"] . " FROM {$checkContent->get_table()} WHERE " . Constant::COLUMN["name"] . " =:name AND " . Constant::COLUMN["site"]["cat_id"] . "=:cat_id";
                $execute = [":name" => htmlentities($formInformation["Name"]), ":cat_id" => $targetId];
                $checkContent->set_sql($check);
                $checkContent->set_execute($execute);
                $allContent =  $checkContent->SELECT();
                if (!empty($allContent)) {
                        echo ('( ' . $formInformation["Name"] . ' ) از قبل موجود است!');
                        return false;
                }
                // --------------------------------------------------------------------
                // اضافه کردن محتوای جدید
                $class = new Controller\CRUD\CRUD_INSERT;
                $class->set_data(["table" => Constant::TABEL["site"]]);
                $sql = "INSERT INTO {$class->get_table()} ( "
                        . Constant::COLUMN["name"]
                        . "," . Constant::COLUMN["site"]["cat_id"]
                        . "," . Constant::COLUMN["user"]
                        . "," . Constant::COLUMN["pass"]
                        . "," . Constant::COLUMN["description"]
                        . "," . Constant::COLUMN["update"] . " ) VALUES ( :name, :cat_id, :user, :pass, :description, :update)";
                $execute = [":name" => htmlentities($formInformation["Name"]), ":cat_id" => $targetId, ":user" => htmlentities($formInformation["UserName"]), ":pass" => htmlentities($formInformation["Password"]), ":description" => htmlentities($formInformation["Description"]), ":update" => date("Y-m-d H:i:s")];
                $class->set_sql($sql);
                $class->set_execute($execute);
                $result = $class->INSERT();
                echo is_numeric($result) ? true : false;
                break;

        case ("content-update"):
                // برسی آنکه نام جدید انتخاب شده در محتواهای موجود در دسته‌بندی مشخص شده در دیتابیس نباشد

                $getCategory = new Controller\CRUD\CRUD_SELECT;
                $getCategory->set_data(["table" => Constant::TABEL["category"]]);
                $sql_getCategory = "SELECT " . Constant::COLUMN["id"] . " FROM {$getCategory->get_table()} WHERE " . Constant::COLUMN["name"] . " =:name ";
                $execute_getCategory = [":name" => htmlentities($categoryName)];
                $getCategory->set_sql($sql_getCategory);
                $getCategory->set_execute($execute_getCategory);
                $getCategoryId =  $getCategory->SELECT()[0]["id"];

                $checkContent = new Controller\CRUD\CRUD_SELECT;
                $checkContent->set_data(["table" => Constant::TABEL["site"]]);
                $check = "SELECT " . Constant::COLUMN["name"] . " FROM {$checkContent->get_table()} WHERE " . Constant::COLUMN["name"] . " =:name AND " . Constant::COLUMN["site"]["cat_id"] . "=:cat_id";
                $execute = [":name" => htmlentities($formInformation["Name"]), ":cat_id" => $getCategoryId];
                $checkContent->set_sql($check);
                $checkContent->set_execute($execute);
                $allContent =  $checkContent->SELECT();
                if (!empty($allContent)) {
                        echo ('( ' . $formInformation["Name"] . ' ) از قبل موجود است!');
                        return false;
                }
                // --------------------------------------------------------------------
                $class = new Controller\CRUD\CRUD_UPDATE;
                $class->set_data(["table" => Constant::TABEL["site"]]);
                $sql = "UPDATE {$class->get_table()} SET "
                        . Constant::COLUMN["name"] . "=:name , "
                        . Constant::COLUMN["user"] . "=:user , "
                        . Constant::COLUMN["pass"] . "=:pass , "
                        . Constant::COLUMN["description"] . "=:description , "
                        . Constant::COLUMN["update"] . "=:update WHERE " . Constant::COLUMN["id"] . "=:id";
                $class->set_sql($sql);
                $execute = [":name" => htmlentities($formInformation["Name"]), ":id" => htmlentities($targetId), ":user" => htmlentities($formInformation["UserName"]), ":pass" => htmlentities($formInformation["Password"]), ":description" => htmlentities($formInformation["Description"]), ":update" => date("Y-m-d H:i:s")];
                $class->set_execute($execute);
                $result = $class->UPDATE();
                echo $result === 1 ? true : false;
                break;

        case ("content-delete"):
                $class = new Controller\CRUD\CRUD_DELETE;
                $class->set_data(["table" => Constant::TABEL["site"]]);
                $sql = "DELETE FROM {$class->get_table()} WHERE "
                        . Constant::COLUMN["id"] . "=:id ";
                $class->set_sql($sql);
                $execute = [":id" => htmlentities($targetId)];
                $class->set_execute($execute);
                $result = $class->DELETE();
                echo ($result === 1) ? true : false;
                break;

        case ("content-select"):
                // برسی آنکه آیا نام جدید انتخاب شده در دسته بندی های موجود در دیتابیس نباشد
                if (!in_array($categoryName, $allCategoryName) && $categoryName !== "all") {
                        echo ('دسته‌بندی ( ' . $categoryName . ' ) موجود نیست!');
                        return false;
                }
                // --------------------------------------------------------------------
                $allContent = new Controller\CRUD\CRUD_SELECT;
                $allContent->set_data(["table" => Constant::TABEL["site"]]);
                $sql_content = "SELECT * FROM {$allContent->get_table()} WHERE " . Constant::COLUMN["site"]["cat_id"] . "=:category ORDER BY " . Constant::COLUMN["name"] . " ASC";
                $allContent->set_execute([":category" => htmlentities($targetId)]);
                if ($targetId === "0") {
                        $sql_content = "SELECT * FROM {$allContent->get_table()} ORDER BY " . Constant::COLUMN["name"] . " ASC";
                        $allContent->set_execute();
                }
                $allContent->set_sql($sql_content);
                $allContentDetailes =  $allContent->SELECT();

                $category = new Controller\CRUD\CRUD_SELECT;
                $category->set_data(["table" => Constant::TABEL["category"]]);

                foreach ($allContentDetailes as $key => $value) {

                        $sql_category = "SELECT " . Constant::COLUMN["name"] . " FROM {$category->get_table()} WHERE " . Constant::COLUMN["id"] . "='{$value["category_id"]}'";
                        $category->set_sql($sql_category);
                        $category->set_execute();
                        $categoryName =  $category->SELECT()[0]["name"];

                        echo "
                        <div class='accordion-item'>
                                <div class='accordion-header' id='content-header-{$value['id']}'>
                                        <button type='button' class='accordion-button collapsed justify-content-between align-items-center px-3 py-2 mb-0 shadow-none' data-bs-toggle='collapse' data-bs-target='#content-collapse-{$value['id']}' aria-expanded='false' aria-controls='content-collapse-{$value['id']}'>
                                                <span>
                                                        <i class='fa-brands fa-chrome'></i>
                                                        <span class='me-1'>{$value['name']}</span>
                                                </span>
                                                <span>
                                                        <i class='fa-solid fa-layer-group'></i>
                                                        <span class='me-1'>{$categoryName}</span>
                                                </span>
                                        </button>
                                        <div id='content-collapse-{$value['id']}'' class='accordion-collapse collapse' aria-labelledby='content-header-{$value['id']}'' data-bs-parent='#accordionContent'>
                                                <div class='accordion-body'>
                                                        <div class='row'>
                                                                <div class='col-12 d-flex' dir='rtl'>
                                                                        <span class='me-2 CP-icon'>
                                                                                <i class='fa-solid fa-layer-group'></i>
                                                                        </span>
                                                                        <nav style='--bs-breadcrumb-divider: " . '"\f0d9"' . "' aria-label='breadcrumb'>
                                                                                <ol class='breadcrumb'>
                                                                                        <li class='breadcrumb-item'>{$categoryName}</li>
                                                                                        <li class='breadcrumb-item active' aria-current='page'><a href='https://{$value['name']}'>{$value['name']}</a></li>
                                                                                </ol>
                                                                        </nav>
                                                                </div>
                                                                <div class='col-12 col-md-6 my-3'>
                                                                        <span class='ms-1 CP-icon'>
                                                                                <i class='fa-brands fa-chrome'></i>
                                                                        </span>
                                                                        <a href='https://{$value['name']}' target='_blank' class='fw-bold fst-italic' data-content='name'>{$value['name']}</a>
                                                                </div>
                                                                <div class='col-12 col-md-3 my-3'>
                                                                        <span class='ms-1 CP-icon'>
                                                                                <i class='fa-solid fa-circle-user'></i>
                                                                        </span>
                                                                        <span data-content='username'>{$value['username']}</span>
                                                                </div>
                                                                <div class='col-12 col-md-3 my-3'>
                                                                        <span class='ms-1 CP-icon'>
                                                                                <i class='fa-solid fa-key'></i>
                                                                        </span>
                                                                        <span data-content='password'>{$value['password']}</span>
                                                                </div>
                                                                <div class='col-12 my-3'>
                                                                        <p data-content='description'>" . nl2br($value['description']) . "</p>
                                                                </div>
                                                        </div>
                                                        <div class='d-flex justify-content-between align-items-center'>
                                                                <a class='text-danger CP-icon' data-status='$categoryName' data-id='{$value['id']}' aria-expanded='false' onclick='content_delete(this);'>
                                                                        <i class='fa-solid fa-trash'></i>
                                                                </a>
                                                                <a class='text-warning CP-icon' data-status='$categoryName' data-id='{$value['id']}' aria-expanded='false' onclick='content_update(this);'>
                                                                        <i class='fa-solid fa-pen-to-square'></i>
                                                                </a>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>";
                }
                break;

        default:
                echo 'فرم ارسالی نامعتبر است';
endswitch;
