<!DOCTYPE html>
<html lang="fa" dir="rtl">

<?php include "./View/Header/Head.php"; ?>

<body class="bg-light">
        <?php include "./View/Header/Header.php"; ?>
        <section class="container-fluid">
                <div class="container">
                        <div class="row g-5">
                                <div class="col-xx1-4 col-xl-4 col-lg-4 col-md-5 col-sm-12 col-xs-12 col-12">
                                        <?php include "./View/Category/Category.php"; ?>
                                </div>
                                <div class="col-xx1-8 col-xl-8 col-lg-8 col-md-7 col-sm-12 col-xs-12 col-12">
                                        <?php include "./View/Content/Content.php"; ?>
                                </div>
                        </div>
                </div>
        </section>
        <?php include "./View/Footer/Footer.php"; ?>
        <?php include "./View/Footer/Script.php"; ?>
</body>

</html>