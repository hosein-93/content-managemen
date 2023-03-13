<script src="./View/assets/js/jquery-3.6.4.min.js"></script>
<script src="./View/assets/js/sweetalert2 v11.7.3.js"></script>
<script src="./View/assets/js/popper.v2.9.2.min.js"></script>
<script src="./View/assets/js/bootstrap.min.js"></script>
<script src="./View/assets/js/custom.js"></script>

<?php

use Controller\Constant;
?>

<script>
        function FormSubmit(event) {
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
                                timer: 10000
                        })
                        return false;
                }
                
                console.log(event);

                $.ajax({
                        url: "<?php echo Constant::URL . "/Controller/Ajax/Ajax.php"; ?>",
                        type: event.target.method,
                        data: {
                                data: "form=" + event.target.name + "&" + $(event.target).serialize()
                        },
                        // contentType: false,
                        // cache: false,
                        // processData: false,
                        success: function(data) {
                                $(event.target).trigger("reset"); // to reset form input fields
                        },
                        error: function(e) {
                                console.log(e);
                        }
                });
        }
</script>