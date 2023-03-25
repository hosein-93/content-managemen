const URL = "http://localhost/script.ac/Site-Management";


// فعال شدن تولتیپ بوتسترپ
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
})

// ================================================================
// ================================================================
// ================================================================

// اعتبار سنجی فرم در بوتسترپ
'use strict'
var forms = document.querySelectorAll('.needs-validation')
Array.prototype.slice.call(forms)
        .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                }, false)
        })

// ================================================================
// ================================================================
// ================================================================

function reloadDocument(reload = 500, timeout = 1000) {
        $(document).on("click", function (event) {
                $("body").fadeOut(500);
                setTimeout(function () {
                        location.reload();
                        window.location.replace("");
                        $("body").fadeIn(500);
                }, reload)
        });
        setTimeout(function () {
                $("body").fadeOut(500);
                setTimeout(function () {
                        location.reload();
                        window.location.replace("");
                        $("body").fadeIn(500);
                }, 500)
        }, timeout)
}

// ================================================================
// ================================================================
// ================================================================

// اضافه کردن تگ جستوجوی دسته‌دسته‌بندی و محتوا به سند
function showSearchTag(event) {
        let parent = event.closest("section");
        let search = document.createElement("input");
        let attribute;
        if (parent.dataset.status === "category") {
                attribute = { "type": "text", "name": "search", "placeholder": "جست‌وجوی دسته‌بندی", "class": "form-control shadow-none rounded-3 tagHide", "onkeyup": "searchLive(this)", "autocomplete": "off", "required": "" };
        } else if (parent.dataset.status === "content") {
                attribute = { "type": "text", "name": "search", "placeholder": "جست‌وجوی محتوا", "class": "form-control shadow-none rounded-3 tagHide", "onkeyup": "searchLive(this)", "autocomplete": "off", "required": "" };
        }
        for (let key in attribute) {
                search.setAttribute(key, attribute[key]);
        }
        if (event.getAttribute("aria-expanded") === "false") {
                event.setAttribute("aria-expanded", "true");
                parent.appendChild(search);
                setTimeout((event) => {
                        search.classList.add("formShow", "inputShow");
                }, 100);
        } else {
                parent.querySelector(parent.tagName + " > input").classList.remove("formShow");
                parent.querySelector(parent.tagName + " > input").classList.remove("inputShow");
                setTimeout((event) => {
                        parent.querySelector(parent.tagName + " > input").remove();
                }, 1000);
                event.setAttribute("aria-expanded", "false");
        }
}

// ================================================================
// ================================================================
// ================================================================

// جستوجوی زنده در دسته‌بندی‌ها و محتواهای موجود
function searchLive(event) {
        let status = event.closest("section");
        let parent;
        if (status.dataset.status === "category") {
                parent = document.querySelectorAll('.list-group > *');
                string = "label";
        } else if (status.dataset.status === "content") {
                parent = document.querySelectorAll('.accordion > .accordion-item');
                string = ".accordion-button > span:first-child";
        }
        let searchValue = event.value;
        let parentLength = parent.length;
        console.log(parent);
        for (let i = 0; i < parentLength; i++) {
                tagString = parent[i].querySelector(string);
                // (tagString.innerText.indexOf(searchValue) > -1) ?
                // parent[i].style.display = "block" :
                // parent[i].style.display = "none";
                (tagString.innerText.indexOf(searchValue) > -1)
                        ? parent[i].setAttribute("style", "opacity:1;height:100%;")
                        : parent[i].setAttribute("style", "opacity:0; height:0px; padding:0 !important;");
        }
}

// ================================================================
// ================================================================
// ================================================================

// اضافه کردن مجموعه تگ‌های افزودن دسته بندی جدید
function category_add(event) {
        let buttonParent = event.closest("section");
        let formHtml = '<div class="position-relative w-100"> \
                                        <input type="text" placeholder="نام دسته&zwnj;بندی" name="Name" class="form-control shadow-none rounded-3" autocomplete="off" required> \
                                        <span class="position-absolute top-50 end-0 translate-middle-y bg-white text-danger"> \
                                                <i class="fa-solid fa-star"></i> \
                                        </span> \
                                </div>\
                                <button type="submit" name="Submit" class="btn bg-white border border-1 d-block text-success py-2 ms-2 shadow-none">افزودن</button>';
        let formAttribute = { "action": "#", "method": "POST", "name": "category-insert", "class": "d-flex align-items-center w-100 rounded-3 shadow-sm needs-validation tagHide", "data-status": "insert", "data-id": "0", "onsubmit": "form_submit(event);", "novalidate": "" };
        let form = document.createElement("form");
        for (var key in formAttribute) {
                form.setAttribute(key, formAttribute[key]);
        }
        form.innerHTML = formHtml;
        if (event.getAttribute("aria-expanded") === "false") {
                buttonParent.appendChild(form);
                setTimeout((event) => {
                        form.classList.add("formShow", "formCategoryHeight");
                }, 100);
                event.setAttribute("aria-expanded", "true");
        } else {
                let form = buttonParent.querySelector("form");
                form.classList.remove("formShow");
                form.classList.remove("formCategoryHeight");
                setTimeout((event) => {
                        form.remove();
                }, 1000);
                event.setAttribute("aria-expanded", "false");
        }
        // زمانی که فرم ایجاد شد موارد زیر را چک می کند
        if (event.nextElementSibling.tagName !== "FORM") {
                // return alert("تگ هدف یک فرم نیست!");
        }
        if (event.getAttribute("aria-expanded") === "false") {
                return false;
        }


}

// ================================================================
// ================================================================
// ================================================================

// ویرایش دسته‌بندی‌های موجود
function category_update(event) {
        let categoryParent = event.closest(".list-group-item");
        let formHtml = '<div class="position-relative w-100"> \
                                        <input type="text" placeholder="نام جدید" name="Name" class="form-control shadow-none rounded-3" autocomplete="off" required"> \
                                        <span class="position-absolute top-50 end-0 translate-middle-y bg-white text-danger"> \
                                                <i class="fa-solid fa-star"></i> \
                                        </span> \
                                </div>\
                                <button type="submit" name="Submit" class="btn bg-white border border-1 d-block text-success py-2 ms-2 shadow-none">ویرایش</button>';
        let formAttribute = { "action": "#", "method": "POST", "name": "category-update", "class": "d-flex align-items-center w-100 rounded-3 shadow-sm needs-validation tagHide", "data-status": event.dataset.status, "data-id": event.dataset.id, "onsubmit": "form_submit(event);", "novalidate": "" };
        let form = document.createElement("form");
        for (var key in formAttribute) {
                form.setAttribute(key, formAttribute[key]);
        }
        form.innerHTML = formHtml;
        if (event.getAttribute("aria-expanded") === "false") {
                categoryParent.appendChild(form);
                setTimeout((event) => {
                        form.classList.add("formShow", "formCategoryHeight");
                }, 100);
                event.setAttribute("aria-expanded", "true");
        } else {
                let form = categoryParent.querySelector("form");
                form.classList.remove("formShow");
                form.classList.remove("formCategoryHeight");
                setTimeout((event) => {
                        form.remove();
                }, 600);
                event.setAttribute("aria-expanded", "false");
                console.log(form);
        }
}

// ================================================================
// ================================================================
// ================================================================

// اضافه کردن مجموعه تگ‌های افزودن محتوای جدید
function content_add(event) {
        let buttonParent = event.closest("section");
        let formHtml = '<div class="row g-md-2" dir="ltr"> \
                                        <div class="col-12"> \
                                                <div class="position-relative"> \
                                                        <input type="text" placeholder="Site Name ... " name="Name" class="form-control shadow-none rounded-3" autocomplete="off" required> \
                                                        <span class="position-absolute top-50 start-0 translate-middle-y bg-white text-danger"> \
                                                                <i class="fa-solid fa-star"></i> \
                                                        </span> \
                                                </div> \
                                        </div> \
                                        <div class="col-12 col-md-6"> \
                                                <input type="text" placeholder="User Name ... " name="UserName" class="form-control shadow-none rounded-3" autocomplete="off"> \
                                        </div> \
                                        <div class="col-12 col-md-6"> \
                                                <input type="text" placeholder="Password ... " name="Password" class="form-control shadow-none rounded-3" autocomplete="off"> \
                                        </div> \
                                        <div class="col-12"> \
                                                <textarea placeholder="توضیحات اضافه ... " name="Description" cols="" rows="4" class="form-control shadow-none rounded-3" dir="rtl"></textarea> \
                                        </div> \
                                </div> \
                                <button type="submit" name="Submit" class="btn bg-white border border-1 d-block text-success mt-2 ms-auto shadow-none">افزودن</button>';
        let formAttribute = { "action": "#", "method": "POST", "name": "content-insert", "class": "w-100 rounded-3 shadow-sm validation tagHide", "data-status": event.dataset.status, "data-id": event.dataset.id, "onsubmit": "form_submit(event);", "novalidate": "" };
        let form = document.createElement("form");
        for (var key in formAttribute) {
                form.setAttribute(key, formAttribute[key]);
        }
        form.innerHTML = formHtml;
        if (event.getAttribute("aria-expanded") === "false") {
                buttonParent.appendChild(form);
                setTimeout((event) => {
                        form.classList.add("formShow", "formContentHeight");
                }, 100);
                event.setAttribute("aria-expanded", "true");
        } else {
                let form = buttonParent.querySelector("form");
                form.classList.remove("formShow");
                form.classList.remove("formContentHeight");
                setTimeout((event) => {
                        form.remove();
                }, 1000);
                event.setAttribute("aria-expanded", "false");
        }
        // زمانی که فرم ایجاد شد موارد زیر را چک می کند
        if (event.nextElementSibling.tagName !== "FORM") {
                return alert("تگ هدف یک فرم نیست!");
        }
        if (event.getAttribute("aria-expanded") === "false") {
                return false;
        }
}

// ================================================================
// ================================================================
// ================================================================

// ویرایش محتواهای موجود
function content_update(event) {
        let categoryParent = event.closest(".accordion-body");
        let formHtml = '<div class="row g-md-2" dir="ltr"> \
                                        <div class="col-12 position-relative"> \
                                                <div class="position-relative"> \
                                                        <input type="text" placeholder="Site Name ... " value="' + categoryParent.querySelector('[data-content="name"]').innerText + '" name="Name" class="form-control shadow-none rounded-3" autocomplete="off" required> \
                                                        <span class="position-absolute top-50 start-0 translate-middle-y bg-white text-danger"> \
                                                                <i class="fa-solid fa-star"></i> \
                                                        </span> \
                                                </div> \
                                        </div> \
                                        <div class="col-12 col-md-6"> \
                                                <input type="text" placeholder="User Name ... " value="' + categoryParent.querySelector('[data-content="username"]').innerText + '" name="UserName" class="form-control shadow-none rounded-3" autocomplete="off"> \
                                        </div> \
                                        <div class="col-12 col-md-6"> \
                                                <input type="text" placeholder="Password ... " value="' + categoryParent.querySelector('[data-content="password"]').innerText + '" name="Password" class="form-control shadow-none rounded-3" autocomplete="off"> \
                                        </div> \
                                        <div class="col-12"> \
                                                <textarea placeholder="توضیحات اضافه ... " name="Description" cols="" rows="4" class="form-control shadow-none rounded-3" dir="rtl">' + categoryParent.querySelector('[data-content="description"]').innerText + '</textarea> \
                                        </div> \
                                </div> \
                                <input type="radio" name="NameOld" value="' + categoryParent.querySelector('[data-content="name"]').innerText + '" class="d-none" checked> \
                                <button type="submit" name="Submit" class="btn bg-white border border-1 d-block text-success mt-2 ms-auto shadow-none">ویرایش</button>';
        let formAttribute = { "action": "#", "method": "POST", "name": "content-update", "class": "w-100 rounded-3 shadow-sm validation tagHide", "data-status": event.dataset.status, "data-id": event.dataset.id, "onsubmit": "form_submit(event);", "novalidate": "" };
        let form = document.createElement("form");
        for (var key in formAttribute) {
                form.setAttribute(key, formAttribute[key]);
        }
        form.innerHTML = formHtml;
        if (event.getAttribute("aria-expanded") === "false") {
                categoryParent.appendChild(form);
                setTimeout((event) => {
                        form.classList.add("formShow", "formContentHeight");
                }, 100);
                event.setAttribute("aria-expanded", "true");
        } else {
                let form = categoryParent.querySelector("form");
                form.classList.remove("formShow");
                form.classList.remove("formContentHeight");
                setTimeout((event) => {
                        form.remove();
                }, 600);
                event.setAttribute("aria-expanded", "false");
        }
}

// ================================================================
// ================================================================
// ================================================================

// حذف محتوای موجود
function content_delete(event) {
        let categoryParent = event.closest(".accordion-body");
        Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: " با تایید عمل حذف، اطلاعات ( " + categoryParent.querySelector(".row a").innerText + " ) به همراه تمام محتواین آن برای همیشه حذف خواهند شد! ",
                icon: 'error',
                showCancelButton: true,
                cancelButtonText: 'انصراف',
                cancelButtonColor: 'var(--bs-secondary)',
                confirmButtonText: 'حذف',
                confirmButtonColor: 'var(--bs-danger)',
                timer: 5000,
                timerProgressBar: true,
                showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                }
        }).then((result) => {
                if (result.isConfirmed) {
                        event.setAttribute("aria-expanded", "true");
                        $.ajax({
                                url: URL + "/Controller/Ajax.php",
                                type: "POST",
                                data: {
                                        data: "form=content-delete&Number=" + event.dataset.categoryDelete,
                                },
                                success: function (data) {
                                        Swal.fire({
                                                position: 'center-center',
                                                icon: "successfully",
                                                title: 'حذف!',
                                                text: 'اطلاعات ( ' + categoryParent.querySelector(".row a").innerText + ' ) با موفقیت حذف شد.',
                                                confirmButtonColor: 'var(--bs-success)',
                                                timer: 2000,
                                                timerProgressBar: true
                                        });
                                        setTimeout(function () {
                                                location.reload();
                                                window.location.replace("");
                                        }, 2500);
                                }
                        });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                                title: 'انصراف!',
                                text: 'شما از حذف اطلاعات ( ' + categoryParent.querySelector(".row a").innerText + ' ) صرفه نظر کردید.',
                                icon: 'warning',
                                confirmButtonColor: 'var(--bs-warning)',
                                timer: 2000,
                                timerProgressBar: true,
                        })
                        event.setAttribute("aria-expanded", "false");
                }
        })
}