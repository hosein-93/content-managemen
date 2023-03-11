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
function addSearchCategory(event) {
        let search = document.createElement("input");
        let searchAttribute = { "type": "text", "name": "searchCategory", "placeholder": "جست‌وجوی دسته‌بندی", "class": "form-control shadow-none rounded-3 tagHide", "data-search": "category", "onkeyup": "searchCategory(this)", "required": "" };
        for (var key in searchAttribute) {
                search.setAttribute(key, searchAttribute[key]);
        }

        if (event.getAttribute("aria-expanded") === "false") {
                event.setAttribute("aria-expanded", "true");
                setTimeout((event) => {
                        search.classList.add("inputShow");
                }, 100);
                event.closest("section").appendChild(search);
        } else {
                let searchInput = document.querySelector("input[data-search='category']");
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
        let formHtml = '<input type="text" placeholder="نام دسته&zwnj;بندی" name="addCategoryName" class="form-control shadow-none mb-2 rounded-3" required> \
                                <select name="addCategoryParent" class="form-select form-select-sm shadow-none mb-2 rounded-3" size="1" required>  \
                                        <option selected> Open this select menu </option> \
                                        <option value="1">One</option> \
                                        <option value="2">Two</option> \
                                        <option value="3">Three</option> \
                                </select> \
                                <button type="submit" name="submitCreateNewCategory" class="btn bg-white border border-1 d-block text-success ms-auto">افزودن</button>';
        let formAttribute = { "action": "#", "method": "POST", "name": "addCategoryForm", "class": "w-100 rounded-3 shadow-sm needs-validation tagHide", "data-form": "addCategory", "novalidate": "" };

        let form = document.createElement("form");
        for (var key in formAttribute) {
                form.setAttribute(key, formAttribute[key]);
        }
        form.innerHTML = formHtml;

        if (event.getAttribute("aria-expanded") === "false") {
                addCategoryButtonParent.appendChild(form);
                setTimeout((event) => {
                        form.classList.add("formShow");
                }, 100);
                event.setAttribute("aria-expanded", "true");
        } else {
                let form = document.querySelector("form[data-form='addCategory']");
                form.classList.remove("formShow");
                setTimeout((event) => {
                        form.remove();
                }, 1000);
                event.setAttribute("aria-expanded", "false");
        }
}

// ================================================================
// ================================================================
// ================================================================

// ویرایش دسته‌بندی‌های موجود
function editCategory(event) {
        let categoryParent = event.closest(".list-group-item");
        let formHtml = '<input type="text" placeholder="نام جدید" name="editCategory-' + event.dataset.categoryEdit + '" class="form-control shadow-none mb-2 rounded-3" required"> \
                                <select name="editCategoryParent-' + event.dataset.categoryEdit + '" class="form-select form-select-sm shadow-none mb-2 rounded-3" size="1" required>  \
                                        <option selected> Open this select menu </option> \
                                        <option value="1">One</option> \
                                        <option value="2">Two</option> \
                                        <option value="3">Three</option> \
                                </select> \
                                <input type="radio" value="' + event.dataset.categoryEdit + '" class="form-check-input d-none" checked disabled required> \
                                <button type="submit" name="submitEditNewCategory-' + event.dataset.categoryEdit + '" class="btn bg-white border border-1 d-block text-success ms-auto">ویرایش</button>';
        let formAttribute = { "action": "#", "method": "POST", "name": "editCategoryForm-" + event.dataset.categoryEdit, "class": "w-100 rounded-3 shadow-sm needs-validation tagHide", "data-form": "editCategory", "novalidate": "" };

        let form = document.createElement("form");
        for (var key in formAttribute) {
                form.setAttribute(key, formAttribute[key]);
        }
        form.innerHTML = formHtml;

        if (event.getAttribute("aria-expanded") === "false") {
                categoryParent.appendChild(form);
                setTimeout((event) => {
                        form.classList.add("formShow");
                }, 100);
                event.setAttribute("aria-expanded", "true");
        } else {
                let form = categoryParent.querySelector("form");
                form.classList.remove("formShow");
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
function addSearchContent(event) {
        let search = document.createElement("input");
        let searchAttribute = { "type": "text", "name": "searchContent", "placeholder": "جست‌وجوی محتوا", "class": "form-control shadow-none rounded-3 tagHide", "data-search": "content", "onkeyup": "searchContent(this)", "required": "" };
        for (var key in searchAttribute) {
                search.setAttribute(key, searchAttribute[key]);
        }

        if (event.getAttribute("aria-expanded") === "false") {
                event.setAttribute("aria-expanded", "true");
                setTimeout((event) => {
                        search.classList.add("inputShow");
                }, 100);
                event.closest("section").appendChild(search);
        } else {
                let searchInput = document.querySelector("input[data-search='content']");
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
                                        <div class="col-12 col-md-6"> \
                                                <input type="text" placeholder="Site Name ... " name="addContentName" class="form-control shadow-none rounded-3" required> \
                                        </div> \
                                        <div class="col-12 col-md-6" dir="rtl"> \
                                                <select name="addContentCategory" class="form-select form-select-sm shadow-none mb-2 rounded-3" size="1" required> \
                                                        <option selected> Open this select menu </option> \
                                                        <option value="1">One</option> \
                                                        <option value="2">Two</option> \
                                                        <option value="3">Three</option> \
                                                </select> \
                                        </div> \
                                        <div class="col-12 col-md-6"> \
                                                <input type="text" placeholder="User Name ... " name="addContentUserName" class="form-control shadow-none rounded-3"> \
                                        </div> \
                                        <div class="col-12 col-md-6"> \
                                                <input type="text" placeholder="Password ... " name="addContentPassword" class="form-control shadow-none rounded-3"> \
                                        </div> \
                                        <div class="col-12"> \
                                                <textarea placeholder="توضیحات اضافه ... " name="addContentDescription" cols="" rows="4" class="form-control shadow-none rounded-3" dir="rtl"></textarea> \
                                        </div> \
                                </div> \
                                <button type="submit" name="submitCreateNewContent" class="btn bg-white border border-1 d-block text-success mt-2 ms-auto">افزودن</button>';
        let formAttribute = { "action": "#", "method": "POST", "name": "addContentForm", "class": "w-100 rounded-3 shadow-sm validation tagHide", "data-form": "addContent", "novalidate": "" };

        let form = document.createElement("form");
        for (var key in formAttribute) {
                form.setAttribute(key, formAttribute[key]);
        }
        form.innerHTML = formHtml;

        if (event.getAttribute("aria-expanded") === "false") {
                addCategoryButtonParent.appendChild(form);
                setTimeout((event) => {
                        form.classList.add("formShow");
                }, 100);
                event.setAttribute("aria-expanded", "true");
        } else {
                let form = document.querySelector("form[data-form='addContent']");
                form.classList.remove("formShow");
                setTimeout((event) => {
                        form.remove();
                }, 1000);
                event.setAttribute("aria-expanded", "false");
        }
}

// ================================================================
// ================================================================
// ================================================================

// ویرایش محتواهای موجود
function editContent(event) {
        let categoryParent = event.closest(".accordion-body");
        let formHtml = '<div class="row g-md-2" dir="ltr"> \
                                        <div class="col-12 col-md-6"> \
                                                <input type="text" placeholder="Site Name ... " name="edditContentName-' + event.dataset.contentEdit + '" class="form-control shadow-none rounded-3" required> \
                                        </div> \
                                        <div class="col-12 col-md-6" dir="rtl"> \
                                                <select name="edditContentCategory" class="form-select form-select-sm shadow-none mb-2 rounded-3" size="1" required> \
                                                        <option selected> Open this select menu </option> \
                                                        <option value="1">One</option> \
                                                        <option value="2">Two</option> \
                                                        <option value="3">Three</option> \
                                                </select> \
                                        </div> \
                                        <div class="col-12 col-md-6"> \
                                                <input type="text" placeholder="User Name ... " name="edditContentUserName-' + event.dataset.contentEdit + '" class="form-control shadow-none rounded-3"> \
                                        </div> \
                                        <div class="col-12 col-md-6"> \
                                                <input type="text" placeholder="Password ... " name="editContentPassword-' + event.dataset.contentEdit + '" class="form-control shadow-none rounded-3"> \
                                        </div> \
                                        <div class="col-12"> \
                                                <textarea placeholder="توضیحات اضافه ... " name="editContentDescription-' + event.dataset.contentEdit + '" cols="" rows="4" class="form-control shadow-none rounded-3" dir="rtl"></textarea> \
                                        </div> \
                                        <input type="radio" value="' + event.dataset.contentEdit + '" class="form-check-input d-none" checked disabled="" required=""> \
                                </div> \
                                <button type="submit" name="submitEditContent" class="btn bg-white border border-1 d-block text-success mt-2 ms-auto">ویرایش</button>';
        let formAttribute = { "action": "#", "method": "POST", "name": "editContentForm-" + event.dataset.contentEdit, "class": "w-100 rounded-3 shadow-sm validation tagHide", "data-form": "editContent", "novalidate": "" };

        let form = document.createElement("form");
        for (var key in formAttribute) {
                form.setAttribute(key, formAttribute[key]);
        }
        form.innerHTML = formHtml;

        if (event.getAttribute("aria-expanded") === "false") {
                categoryParent.appendChild(form);
                setTimeout((event) => {
                        form.classList.add("formShow");
                }, 100);
                event.setAttribute("aria-expanded", "true");
        } else {
                let form = categoryParent.querySelector("form");
                form.classList.remove("formShow");
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