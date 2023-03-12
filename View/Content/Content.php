<?php

?>

<main class="row align-content-start py-3">
        <section class="col-12 d-flex justify-content-between align-items-center flex-wrap py-3 rounded-3 C-background">
                <button type="button" class="btn btn-secondary d-flex p-2 shadow-none" data-bs-toggle="tooltip" data-bs-placement="top" title="جستوجوی محتوا" aria-expanded="false" onclick="showTagSearchContent(this)">
                        <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <span class="text-white">محتوا</span>
                <button type="button" class="btn btn-secondary d-flex p-2 shadow-none" data-bs-toggle="tooltip" data-bs-placement="top" title="افزودن محتوا" aria-expanded="false" onclick="addContent(this)">
                        <i class="fa-solid fa-book"></i>
                </button>
        </section>
        <section class="col-12 px-0" dir="ltr">
                <div class="accordion accordion-flush my-3" id="accordionContent" data-searchLive="content">
                        <div class="accordion-item">
                                <div class="accordion-header" id="content-header-1">
                                        <button type="button" class="accordion-button collapsed justify-content-between align-items-center p-2 p-md-3 mb-0 shadow-none" data-bs-toggle="collapse" data-bs-target="#content-collapse-1" aria-expanded="false" aria-controls="content-collapse-1">
                                                <span>
                                                        <i class="fa-brands fa-chrome"></i>
                                                        <span class="me-1">digikala.com</span>
                                                </span>
                                                <span>
                                                        <i class="fa-solid fa-layer-group"></i>
                                                        <span class="me-1">css</span>
                                                </span>
                                        </button>
                                </div>
                                <div id="content-collapse-1" class="accordion-collapse collapse" aria-labelledby="content-header-1" data-bs-parent="#accordionContent">
                                        <div class="accordion-body">
                                                <div class="row">
                                                        <div class="col-12 d-flex" dir="rtl">
                                                                <span class="me-2 CP-icon">
                                                                        <i class="fa-solid fa-layer-group"></i>
                                                                </span>
                                                                <nav style="--bs-breadcrumb-divider: '\f0d9'" aria-label="breadcrumb">
                                                                        <ol class="breadcrumb">
                                                                                <li class="breadcrumb-item"><a href="#">home</a></li>
                                                                                <li class="breadcrumb-item"><a href="#">front-end</a></li>
                                                                                <li class="breadcrumb-item active" aria-current="page">css</li>
                                                                        </ol>
                                                                </nav>
                                                        </div>
                                                        <div class="col-12 col-md-6 my-3">
                                                                <span class="ms-1 CP-icon">
                                                                        <i class="fa-brands fa-chrome"></i>
                                                                </span>
                                                                <a href="https://digikala.com" target="_blank" class="fw-bold fst-italic">digikala.com</a>
                                                        </div>
                                                        <div class="col-12 col-md-3 my-3">
                                                                <span class="ms-1 CP-icon">
                                                                        <i class="fa-solid fa-circle-user"></i>
                                                                </span>
                                                                <span>user name</span>
                                                        </div>
                                                        <div class="col-12 col-md-3 my-3">
                                                                <span class="ms-1 CP-icon">
                                                                        <i class="fa-solid fa-key"></i>
                                                                </span>
                                                                <span>password</span>
                                                        </div>
                                                        <div class="col-12 my-3">
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam magnam a dolores ratione commodi amet voluptas explicabo possimus maiores incidunt praesentium molestias dolorum, rem quaerat esse sint dolore odit! Aliquam?</p>
                                                        </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                        <a class="text-danger CP-icon" data-content-delete="1" aria-expanded="false" onclick="deleteContent(this);">
                                                                <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        <a class="text-warning CP-icon" data-content-edit="1" aria-expanded="false" onclick="editContent(this);">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </section>
</main>