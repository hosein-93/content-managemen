// اضافه کردن تگ جستوجوی دسته بندی به سند
function addSearchCategory(event) {
        let search = document.createElement("input");
        let searchAttribute = { "type": "text", "name": "searchCategory", "placeholder": "جست‌وجوی دسته‌بندی", "class": "tagHide", "data-search": "category", "onkeyup": "searchCategory(this)" };
        for (var key in searchAttribute) {
                search.setAttribute(key, searchAttribute[key]);
        }

        if (event.getAttribute("aria-expanded") === "false") {
                event.setAttribute("aria-expanded", "true");
                setTimeout((event) => {
                        search.classList.add("inputShow");
                }, 100);
                event.closest("div").appendChild(search);
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
                (tagString.innerText.indexOf(searchValue) > -1) ?
                        tagParent[counter].style.display = "block" :
                        tagParent[counter].style.display = "none";
        }
}

// ================================================================
// ================================================================
// ================================================================

function addCategory(event) {

        let addCategoryButtonParent = event.closest("div");
        let formHtml = '<input type="text" placeholder="نام دسته&zwnj;بندی" name="addCategoryName"> \
                                <select name="addCategoryParent" class="form-select form-select-sm" size="1">  \
                                        <option selected=""> Open this select menu </option> \
                                        <option value="1">One</option> \
                                        <option value="2">Two</option> \
                                        <option value="3">Three</option> \
                                </select> \
                                <button type="submit" name="submitCreateNewCategory" class="btn btn-light border-0 d-block text-success ms-auto shadow-sm">افزودن</button>';
        let formAttribute = { "action": "#", "method": "POST", "name": "addCategoryForm", "class": "w-100 bg-white rounded-3 shadow-sm tagHide", "data-form": "Category" };

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
                let form = document.querySelector("form[data-form='Category']");
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
        let formHtml = '<input type="text" placeholder="نام جدید" name="editCategory-' + event.dataset.categoryEdit + '"> \
                                <select name="editCategoryParent-' + event.dataset.categoryEdit + '" class="form-select form-select-sm" size="1">  \
                                        <option selected=""> Open this select menu </option> \
                                        <option value="1">One</option> \
                                        <option value="2">Two</option> \
                                        <option value="3">Three</option> \
                                </select> \
                                <input type="radio" value="' + event.dataset.categoryEdit + '" class="d-none" checked disabled> \
                                <button type="submit" name="submitEditNewCategory-' + event.dataset.categoryEdit + '" class="btn btn-white bg-white border-0 d-block text-success ms-auto shadow-sm">ویرایش</button>';
        let formAttribute = { "action": "#", "method": "POST", "name": "editCategoryForm-" + event.dataset.categoryEdit, "class": "w-100 bg-dark rounded-3 shadow-sm tagHide" };

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
                text: "با تایید عمل حذف، دسته‌بندی ( " + categoryParent.innerText + ") به همراه تمام محتواین آن برای همیشه حذف خواهند شد!",
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







// جستوجوی زنده اکانت‌های موجود
function searchContent(event) {
        let searchValue = event.value;
        let tagParent = document.querySelectorAll('[data-searchLive="category"] > *');
        let parentLength = tagParent.length;
        for (counter = 0; counter < parentLength; counter++) {
                tagString = tagParent[counter].querySelector("label");
                (tagString.innerText.indexOf(searchValue) > -1) ?
                        tagParent[counter].style.display = "block" :
                        tagParent[counter].style.display = "none";
        }
}

// ================================================================
// ================================================================
// ================================================================




