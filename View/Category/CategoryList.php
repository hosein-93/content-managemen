<?php

?>

<section class="col-12 px-0">
        <div class="list-group my-3" data-searchLive="category">
                <div class="list-group-item form-switch d-flex justify-content-between align-items-center flex-wrap p-2 p-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                                <input type="checkbox" name="Category-Name-1" class="form-check-input m-0 me-2" id="Category-Name-1">
                                <label class="form-check-label" for="Category-Name-1">hosein</label>
                        </div>
                        <div class="float-end">
                                <a class="text-warning me-2 CP-icon" data-category-edit="1" aria-expanded="false" onclick="editCategory(this);">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="text-danger CP-icon" data-category-delete="1" aria-expanded="false" onclick="deleteCategory(this);">
                                        <i class="fa-solid fa-trash"></i>
                                </a>
                        </div>
                </div>
</section>