<?php
use Controller\Constant;
?>

<section class="col-12 px-0" dir="ltr">
        <script src="./View/assets/js/lottie-player.js"></script>
        <div class="accordion accordion-flush my-3 position-relative" id="accordionContent">
                <lottie-player class="position-absolute top-0 start-50 translate-middle-x d-none" src="./View/assets/img/loder.json" background="transparent" speed="1" style="width: 300px; height: 300px;z-index:2;" loop autoplay></lottie-player>
                <?php

                $category = new Controller\CRUD\CRUD_SELECT;
                $category->set_data(["table" => Constant::TABEL["category"]]);

                foreach ($allContentDetailes as $key => $value) :

                        $sql_category = "SELECT " . Constant::COLUMN["name"] . " FROM {$category->get_table()} WHERE " . Constant::COLUMN["id"] . "='{$value["category_id"]}'";
                        $category->set_sql($sql_category);
                        $category->set_execute();
                        $categoryName =  $category->SELECT()[0]["name"];

                ?>
                        <div class="accordion-item">
                                <div class="accordion-header" id="content-header-{<?php echo $value["id"]; ?>}">
                                        <button type="button" class="accordion-button collapsed justify-content-between align-items-center px-3 py-2 mb-0 shadow-none" data-bs-toggle="collapse" data-bs-target="#content-collapse-<?php echo $value["id"]; ?>" aria-expanded="false" aria-controls="content-collapse-<?php echo $value["id"]; ?>">
                                                <span>
                                                        <i class="fa-brands fa-chrome"></i>
                                                        <span class="me-1"><?php echo $value["name"]; ?></span>
                                                </span>
                                                <span>
                                                        <i class="fa-solid fa-layer-group"></i>
                                                        <span class="me-1"><?php echo $categoryName; ?></span>
                                                </span>
                                        </button>
                                </div>
                                <div id="content-collapse-<?php echo $value["id"]; ?>" class="accordion-collapse collapse" aria-labelledby="content-header-<?php echo $value["id"]; ?>" data-bs-parent="#accordionContent">
                                        <div class="accordion-body">
                                                <div class="row">
                                                        <div class="col-12 d-flex" dir="rtl">
                                                                <span class="me-2 CP-icon">
                                                                        <i class="fa-solid fa-layer-group"></i>
                                                                </span>
                                                                <nav style="--bs-breadcrumb-divider: '\f0d9'" aria-label="breadcrumb">
                                                                        <ol class="breadcrumb">
                                                                                <li class="breadcrumb-item"><?php echo $categoryName; ?></li>
                                                                                <li class="breadcrumb-item"><a href="https://<?php echo $value["name"]; ?>"><?php echo $value["name"]; ?></a></li>
                                                                        </ol>
                                                                </nav>
                                                        </div>
                                                        <div class="col-12 col-md-6 my-3">
                                                                <span class="ms-1 CP-icon">
                                                                        <i class="fa-brands fa-chrome"></i>
                                                                </span>
                                                                <a href="https://<?php echo $value["name"]; ?>" target="_blank" class="fw-bold fst-italic" data-content="name"><?php echo $value["name"]; ?></a>
                                                        </div>
                                                        <div class="col-12 col-md-3 my-3">
                                                                <span class="ms-1 CP-icon">
                                                                        <i class="fa-solid fa-circle-user"></i>
                                                                </span>
                                                                <span data-content="username"><?php echo empty($value["username"]) ? "---" : $value["username"]; ?></span>
                                                        </div>
                                                        <div class="col-12 col-md-3 my-3">
                                                                <span class="ms-1 CP-icon">
                                                                        <i class="fa-solid fa-key"></i>
                                                                </span>
                                                                <span data-content="password"><?php echo empty($value["password"]) ? "---" : $value["password"]; ?></span>
                                                        </div>
                                                        <div class="col-12 my-3">
                                                                <p data-content="description" dir="rtl"><?php echo empty($value["description"]) ? "---" : nl2br($value["description"]); ?></p>
                                                        </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                        <a class="text-danger CP-icon" data-status="<?php echo $categoryName; ?>" data-id="<?php echo $value["id"]; ?>" aria-expanded="false" onclick="content_delete(this);">
                                                                <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        <a class="text-warning CP-icon" data-status="<?php echo $categoryName; ?>" data-id="<?php echo $value["id"]; ?>" aria-expanded="false" onclick="content_update(this);">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                </div>
                                        </div>
                                </div>
                        </div>
                <?php endforeach; ?>
        </div>
</section>