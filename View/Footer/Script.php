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

                let formData = {
                        "form": event.target.name
                };
                for (var i = 0; i < event.target.length; i++) {
                        formData[event.target[i].name] = event.target[i].value;
                }

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