<script src="./View/assets/js/jquery-3.6.4.min.js"></script>
<script src="./View/assets/js/sweetalert2 v11.7.3.js"></script>
<script src="./View/assets/js/popper.v2.9.2.min.js"></script>
<script src="./View/assets/js/bootstrap.min.js"></script>
<script src="./View/assets/js/custom.js"></script>

<?php

use Controller\Constant;
?>

<script>
        function form_submit(event) {
                // event.stopPropagation();
                event.preventDefault();
                if (event.target[0].value === '') {
                        Swal.fire({
                                position: 'center-top',
                                icon: 'warning',
                                title: '',
                                text: 'فیلدهای ستاره‌دار نمی‌توانند خالی باشند.',
                                width: 260,
                                padding: '0 0 1rem 0',
                                showConfirmButton: false,
                                timerProgressBar: true,
                                timer: 1000
                        })
                        return false;
                }
                $.ajax({
                        url: "<?php echo Constant::URL . "/Controller/Ajax.php"; ?>",
                        type: event.target.method,
                        data: {
                                categoryNames: '<?php echo ($allCategoryName); ?>',
                                categoryName: event.target.getAttribute("data-status"),
                                targetId: event.target.getAttribute("data-id"),
                                data: "form=" + event.target.name + "&" + $(event.target).serialize()
                        },
                        // contentType: false,
                        // cache: false,
                        // processData: false,
                        success: function(data) {
                                $(event.target).trigger("reset"); // to reset form input fields
                                Swal.fire({
                                        position: 'top-center',
                                        icon: data === "1" ? "success" : "error",
                                        title: data === "1" ? "عملیات با موفقیت انجام شد!" : data,
                                        showConfirmButton: false,
                                        timer: 1000
                                })
                                $(document).on("click", function() {
                                        location.reload();
                                        window.location.replace("");
                                });
                        },
                        error: function(e) {
                                console.log(e);
                        }
                });
        }

        function category_delete(event) {
                let categoryName = event.closest(".list-group-item").querySelector("label").innerText;
                Swal.fire({
                        title: 'آیا مطمئن هستید؟',
                        text: "با تایید عمل حذف، دسته‌بندی ( " + categoryName + " )  به همراه تمام محتواین آن برای همیشه حذف خواهند شد!",
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
                                $.ajax({
                                        url: URL + "/Controller/Ajax.php",
                                        type: "POST",
                                        data: {
                                                categoryNames: '<?php echo ($allCategoryName); ?>',
                                                categoryName: event.dataset.status,
                                                targetId: event.dataset.id,
                                                data: "form=category-delete",
                                        },
                                        success: function(data) {
                                                Swal.fire({
                                                        position: 'center-center',
                                                        icon: data === "1" ? "success" : "error",
                                                        title: 'حذف!',
                                                        text: data === "1" ? 'دسته‌بندی ( ' + categoryName + ' ) با موفقیت حذف شد.' : "حذف دسته‌بندی با خطا مواجه شد!",
                                                        confirmButtonColor: 'var(--bs-success)',
                                                        timer: 1000,
                                                        timerProgressBar: true
                                                });
                                                $(document).on("click", function() {
                                                        location.reload();
                                                        window.location.replace("");
                                                });
                                                $("#test").html(data);
                                        }
                                });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                                Swal.fire({
                                        title: 'انصراف!',
                                        text: 'شما از حذف دسته‌بندی ( ' + categoryName + ' ) صرفه نظر کردید.',
                                        icon: 'warning',
                                        confirmButtonColor: 'var(--bs-warning)',
                                        timer: 2000,
                                        timerProgressBar: true,
                                })
                        }
                });
        }

        function showContent(event) {
                $("#accordionContent").fadeOut(500);
                setTimeout(function() {
                        $("#accordionContent .accordion-item").remove();
                        $("#accordionContent lottie-player").removeClass("d-none");
                        $("#accordionContent").fadeIn(500);
                }, 500)
                $.ajax({
                        url: "<?php echo Constant::URL . "/Controller/Ajax.php"; ?>",
                        type: "POST",
                        data: {
                                categoryNames: '<?php echo ($allCategoryName); ?>',
                                categoryName: event.dataset.status,
                                targetId: event.dataset.id,
                                data: "form=content-select"
                        },
                        // contentType: false,
                        // cache: false,
                        // processData: false,
                        success: function(data) {
                                setTimeout(function() {
                                        $("#accordionContent").fadeOut(500);
                                }, 1500);
                                setTimeout(function() {
                                        $("#accordionContent lottie-player").addClass("d-none");
                                        $("#accordionContent").append(data);
                                        $("#accordionContent").fadeIn(500);
                                }, 2000);
                        },
                        error: function(e) {
                                console.log(e);
                        }
                });
                // اضافه کردن نام و شناسه دسته بندی به دکمه اضافه کردن محتوا
                $('section[data-status="content"] button')[1].style.scale = 0;
                $('section[data-status="content"] button')[1].setAttribute('data-status', "all");
                $('section[data-status="content"] button')[1].setAttribute('data-id', "0");
                if (event.dataset.status !== "all") {
                        $('section[data-status="content"] button')[1].style.scale = 1;
                        $('section[data-status="content"] button')[1].setAttribute('data-status', event.dataset.status);
                        $('section[data-status="content"] button')[1].setAttribute('data-id', event.dataset.id);
                }
        }

        function content_delete(event) {
                let contentName = event.closest(".accordion-body").querySelector("a").innerText;
                Swal.fire({
                        title: 'آیا مطمئن هستید؟',
                        text: "با تایید عمل حذف، تمام محتوای ( " + contentName + " ) برای همیشه حذف خواهند شد!",
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
                                $.ajax({
                                        url: URL + "/Controller/Ajax.php",
                                        type: "POST",
                                        data: {
                                                categoryNames: '<?php echo ($allCategoryName); ?>',
                                                categoryName: event.dataset.status,
                                                targetId: event.dataset.id,
                                                data: "form=content-delete",
                                        },
                                        success: function(data) {
                                                Swal.fire({
                                                        position: 'center-center',
                                                        icon: data === "1" ? "success" : "error",
                                                        title: 'حذف!',
                                                        text: data === "1" ? ' ( ' + contentName + ' ) با موفقیت حذف شد.' : "حذف با خطا مواجه شد!",
                                                        confirmButtonColor: 'var(--bs-success)',
                                                        timer: 1000,
                                                        timerProgressBar: true
                                                });
                                                $(document).on("click", function() {
                                                        location.reload();
                                                        window.location.replace("");
                                                });
                                        }
                                });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                                Swal.fire({
                                        title: 'انصراف!',
                                        text: 'شما از حذف ( ' + contentName + ' ) صرفه نظر کردید.',
                                        icon: 'warning',
                                        confirmButtonColor: 'var(--bs-warning)',
                                        timer: 2000,
                                        timerProgressBar: true,
                                })
                        }
                });
        }
</script>