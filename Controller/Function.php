<?php

use Controller\Constant;
use Controller\CRUD\CRUD_SELECT;

function showListCategory($select, $margin = 0)
{

        foreach ($select as $key => $value) :
                echo  '<div class="list-group-item form-switch d-flex justify-content-between align-items-center flex-wrap p-2 px-md-3 py-md-2 border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                        <input type="checkbox" name="Category-Name-' . $value["id"] . '" class="form-check-input m-0 me-2" id="Category-Name-' . $value["id"] . '">
                                        <label class="form-check-label" for="Category-Name-' . $value["id"] . '"> ' . $value["name"] . '</label>
                                </div>
                                <div class="float-end">
                                        <a class="text-warning me-2 CP-icon" data-category-edit="' . $value["id"] . '" aria-expanded="false" data-status="editCategory" onclick="editCategory(this);">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a class="text-danger CP-icon" data-category-delete="' . $value["id"] . '" onclick="deleteCategory(this);">
                                                <i class="fa-solid fa-trash"></i>
                                        </a>
                                </div>
                        </div>';
                $selectCategory = new CRUD_SELECT;
                $selectCategory->set_data();
                $sql = "SELECT * FROM {$selectCategory->get_table()} WHERE " . Constant::COLUMN["category"]["parent"] . "='{$value['name']}' ORDER BY " . Constant::COLUMN["name"] . " ASC";
                $selectCategory->set_sql($sql);
                $allCategory =  $selectCategory->SELECT();
                if (!empty($allCategory)) {
                        $margin += 16;
                        echo '<div style="margin-right: ' . $margin . 'px">';
                        showListCategory($allCategory, $margin);
                        echo '</div>';
                }
        endforeach;
}
