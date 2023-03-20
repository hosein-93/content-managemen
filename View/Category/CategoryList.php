<?php

use Controller\Constant;

?>
<section class="col-12 px-0">
        <div class="list-group bg-white my-3">
        <?php if(!empty($allCategoryDetailes)) :  ?>
                <div class="list-group-item form-switch d-flex justify-content-between align-items-center flex-wrap p-2 px-md-3 py-md-2 border-0">
                        <div class="d-flex justify-content-start align-items-center">
                                <input type="radio" name="category" class="form-check-input m-0 me-2" id="Category-Name" data-status="all" data-id="0" onclick="showContent(this);" checked>
                                <label class="form-check-label" for="Category-Name">همه</label>
                        </div>
                </div>
                <?php
                endif;
                foreach ($allCategoryDetailes as $key => $value) :
                ?>
                        <div class="list-group-item form-switch d-flex justify-content-between align-items-center flex-wrap p-2 px-md-3 py-md-2 border-0">
                                <div class="d-flex justify-content-start align-items-center">
                                        <input type="radio" name="category" class="form-check-input m-0 me-2" id="Category-Name-<?php echo $value["id"]; ?>" data-status=<?php echo $value["name"]; ?> data-id=<?php echo $value["id"]; ?> onclick="showContent(this);">
                                        <label class="form-check-label" for="Category-Name-<?php echo $value["id"]; ?>"><?php echo $value["name"]; ?></label>
                                </div>
                                <div class="float-end">
                                        <a class="text-warning me-2 CP-icon" data-status="<?php echo $value["name"]; ?>" data-id="<?php echo $value["id"]; ?>" aria-expanded="false" data-status="category_update" onclick="category_update(this);">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a class="text-danger CP-icon" data-status="<?php echo $value["name"]; ?>" data-id="<?php echo $value["id"]; ?>" onclick="category_delete(this);">
                                                <i class="fa-solid fa-trash"></i>
                                        </a>
                                </div>
                        </div>
                <?php
                endforeach;
                ?>
        </div>
</section>