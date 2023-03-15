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

// اضافه کردن تگ جستوجوی دسته بندی به سند
function showTagSearchCategory(event) {
        let search = document.createElement("input");
        let searchAttribute = { "type": "text", "name": "searchCategory", "placeholder": "جست‌وجوی دسته‌بندی", "class": "form-control shadow-none rounded-3 tagHide", "data-search": "category", "onkeyup": "searchCategory(this)", "autocomplete":"off", "required": ""};
        for (let key in searchAttribute) {
                search.setAttribute(key, searchAttribute[key]);
        }

        if (event.getAttribute("aria-expanded") === "false") {
                event.setAttribute("aria-expanded", "true");
                setTimeout((event) => {
                        search.classList.add("formShow", "inputShow");
                }, 100);
                event.closest("section").appendChild(search);
        } else {
                let searchInput = document.querySelector("input[data-search='category']");
                searchInput.classList.remove("formShow");
                searchInput.classList.remove("inputShow");
                setTimeout((event) => {
                        searchInput.remove();
                }, 1000);
                event.setAttribute("aria-expanded", "false");
        }
}

// ================================================================
// ================================================================
// ================================================================

// جستوجوی زنده دسته‌بندی‌های موجود
function searchCategory(event) {
        let searchValue = event.value;
        let tagParent = document.querySelectorAll('[data-searchLive="category"] > *');
        let parentLength = tagParent.length;
        for (counter = 0; counter < parentLength; counter++) {
                tagString = tagParent[counter].querySelector("label");
                // (tagString.innerText.indexOf(searchValue) > -1) ?
                // tagParent[counter].style.display = "block" :
                // tagParent[counter].style.display = "none";
                (tagString.innerText.indexOf(searchValue) > -1) ?
                        tagParent[counter].setAttribute("style", "opacity:1;height:100%;") :
                        tagParent[counter].setAttribute("style", "opacity:0; height:0px; padding:0 !important;");
        }
}

// ================================================================
// ================================================================
// ================================================================

// اضافه کردن مجموعه تگ‌های افزودن دسته بندی جدید
function addCategory(event) {
        let addCategoryButtonParent = event.closest("section");
        let formHtml = '<div class="position-relative"> \
                                        <input type="text" placeholder="نام دسته&zwnj;بندی" name="Name" class="form-control shadow-none mb-2 rounded-3" autocomplete="off" required> \
                                        <span class="position-absolute top-50 end-0 translate-middle-y bg-white text-danger"> \
                                                <i class="fa-solid fa-star"></i> \
                                        </span> \
                                </div>\
                                <select name="Parent" class="form-select form-select-sm shadow-none mb-2 rounded-3" size="1" onclick="createOption(this);" required></select> \
                                <input type="radio" name="Number" value="0" class="form-check-input d-none" checked required> \
                                <button type="submit" name="Submit" class="btn bg-white border border-1 d-block text-success ms-auto shadow-none">افزودن</button>';
        let formAttribute = { "action": "#", "method": "POST", "name": "CRUDCategoryAdd", "class": "w-100 rounded-3 shadow-sm needs-validation tagHide", "onsubmit": "FormSubmit(event);", "novalidate": "" };

        let form = document.createElement("form");
        for (var key in formAttribute) {
                form.setAttribute(key, formAttribute[key]);
        }
        form.innerHTML = formHtml;

        if (event.getAttribute("aria-expanded") === "false") {
                addCategoryButtonParent.appendChild(form);
                setTimeout((event) => {
                        form.classList.add("formShow", "formCategoryHeight");
                }, 100);
                event.setAttribute("aria-expanded", "true");
        } else {
                let form = addCategoryButtonParent.querySelector("form");
                form.classList.remove("formShow");
                form.classList.remove("formCategoryHeight");
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

// ویرایش دسته‌بندی‌های موجود
function editCategory(event) {
        let categoryParent = event.closest(".list-group-item");
        let formHtml = '<div class="position-relative"> \
                                        <input type="text" placeholder="نام جدید" name="Name" class="form-control shadow-none mb-2 rounded-3" autocomplete="off" required"> \
                                        <span class="position-absolute top-50 end-0 translate-middle-y bg-white text-danger"> \
                                                <i class="fa-solid fa-star"></i> \
                                        </span> \
                                </div>\
                                <select name="Parent" class="form-select form-select-sm shadow-none mb-2 rounded-3" size="1" required></select> \
                                <input type="radio" name="Number" value="' + event.dataset.categoryEdit + '" class="form-check-input d-none" checked required> \
                                <button type="submit" name="Submit" class="btn bg-white border border-1 d-block text-success ms-auto shadow-none">ویرایش</button>';
        let formAttribute = { "action": "#", "method": "POST", "name": "CRUDCategoryEdit", "class": "w-100 rounded-3 shadow-sm needs-validation tagHide", "onsubmit": "FormSubmit(event);", "novalidate": "" };

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
        }

}

// ================================================================
// ================================================================
// ================================================================

// حذف دسته‌بندی‌های موجود
function deleteCategory(event) {
        let categoryParent = event.closest(".list-group-item");
        Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: "با تایید عمل حذف، دسته‌بندی ( " + categoryParent.innerText + " )  به همراه تمام محتواین آن برای همیشه حذف خواهند شد!",
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
                        Swal.fire({
                                title: 'حذف!',
                                text: 'دسته‌بندی ( ' + categoryParent.innerText + ' ) با موفقیت حذف شد.',
                                icon: 'success',
                                confirmButtonColor: 'var(--bs-success)',
                                timer: 2000,
                                timerProgressBar: true,
                        })
                        event.setAttribute("aria-expanded", "true");
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                                title: 'انصراف!',
                                text: 'شما از حذف دسته‌بندی ( ' + categoryParent.innerText + ' ) صرفه نظر کردید.',
                                icon: 'warning',
                                confirmButtonColor: 'var(--bs-warning)',
                                timer: 2000,
                                timerProgressBar: true,
                        })
                        event.setAttribute("aria-expanded", "false");
                }
        })
}

// ================================================================
// ================================================================
// ================================================================

// اضافه کردن تگ جستوجوی محتوا به سند
function showTagSearchContent(event) {
        let search = document.createElement("input");
        let searchAttribute = { "type": "text", "name": "searchContent", "placeholder": "جست‌وجوی محتوا", "class": "form-control shadow-none rounded-3 tagHide", "data-search": "content", "onkeyup": "searchContent(this)", "autocomplete":"off", "required": "" };
        for (var key in searchAttribute) {
                search.setAttribute(key, searchAttribute[key]);
        }

        if (event.getAttribute("aria-expanded") === "false") {
                event.setAttribute("aria-expanded", "true");
                setTimeout((event) => {
                        search.classList.add("formShow", "inputShow");
                }, 100);
                event.closest("section").appendChild(search);
        } else {
                let searchInput = document.querySelector("input[data-search='content']");
                searchInput.classList.remove("inputShow");
                searchInput.classList.remove("formShow");
                setTimeout((event) => {
                        searchInput.remove();
                }, 1000);
                event.setAttribute("aria-expanded", "false");
        }
}

// ================================================================
// ================================================================
// ================================================================

// جستوجوی زنده محتواهای موجود
function searchContent(event) {
        let searchValue = event.value;
        let tagParent = document.querySelectorAll('[data-searchLive="content"] > *');
        let parentLength = tagParent.length;
        for (counter = 0; counter < parentLength; counter++) {
                tagString = tagParent[counter].querySelector(".accordion-button > span ");
                // (tagString.innerText.indexOf(searchValue) > -1) ?
                // tagParent[counter].style.display = "block" :
                // tagParent[counter].style.display = "none";
                (tagString.innerText.indexOf(searchValue) > -1) ?
                        tagParent[counter].setAttribute("style", "opacity:1;height:100%;") :
                        tagParent[counter].setAttribute("style", "opacity:0; height:0px;");
        }
}

// ================================================================
// ================================================================
// ================================================================

// اضافه کردن مجموعه تگ‌های افزودن محتوای جدید
function addContent(event) {
        let addCategoryButtonParent = event.closest("section");
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
                                        <input type="radio" name="Number" value="0" class="form-check-input d-none" checked required> \
                                </div> \
                                <button type="submit" name="Submit" class="btn bg-white border border-1 d-block text-success mt-2 ms-auto shadow-none">افزودن</button>';

        let formAttribute = { "action": "#", "method": "POST", "name": "CRUDContentAdd", "class": "w-100 rounded-3 shadow-sm validation tagHide", "onsubmit": "FormSubmit(event);", "novalidate": "" };

        let form = document.createElement("form");
        for (var key in formAttribute) {
                form.setAttribute(key, formAttribute[key]);
        }
        form.innerHTML = formHtml;

        if (event.getAttribute("aria-expanded") === "false") {
                addCategoryButtonParent.appendChild(form);
                setTimeout((event) => {
                        form.classList.add("formShow", "formContentHeight");
                }, 100);
                event.setAttribute("aria-expanded", "true");
        } else {
                let form = addCategoryButtonParent.querySelector("form");
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
function editContent(event) {
        let categoryParent = event.closest(".accordion-body");
        let formHtml = '<div class="row g-md-2" dir="ltr"> \
                                        <div class="col-12 col-md-6 position-relative"> \
                                                <div class="position-relative"> \
                                                        <input type="text" placeholder="Site Name ... " name="Name" class="form-control shadow-none rounded-3" autocomplete="off" required> \
                                                        <span class="position-absolute top-50 start-0 translate-middle-y bg-white text-danger"> \
                                                                <i class="fa-solid fa-star"></i> \
                                                        </span> \
                                                </div> \
                                        </div> \
                                        <div class="col-12 col-md-6" dir="rtl"> \
                                                <select name="Category" class="form-select form-select-sm shadow-none mb-2 rounded-3" size="1" autocomplete="off" required></select> \
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
                                        <input type="radio" name="Number" value="' + event.dataset.contentEdit + '" class="form-check-input d-none" checked required> \
                                </div> \
                                <button type="submit" name="Submit" class="btn bg-white border border-1 d-block text-success mt-2 ms-auto shadow-none">ویرایش</button>';

        let formAttribute = { "action": "#", "method": "POST", "name": "CRUDContentEdit", "class": "w-100 rounded-3 shadow-sm validation tagHide", "onsubmit": "FormSubmit(event);", "novalidate": "" };

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
function deleteContent(event) {
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
                        Swal.fire({
                                title: 'حذف!',
                                text: 'اطلاعات ( ' + categoryParent.querySelector(".row a").innerText + ' ) با موفقیت حذف شد.',
                                icon: 'success',
                                confirmButtonColor: 'var(--bs-success)',
                                timer: 2000,
                                timerProgressBar: true,
                        })
                        event.setAttribute("aria-expanded", "true");
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