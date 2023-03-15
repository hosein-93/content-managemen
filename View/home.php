<!DOCTYPE html>
<html lang="fa" dir="rtl">

<?php include "./View/Header/Head.php"; ?>

<body class="bg-light">
        <?php include "./View/Header/Header.php"; ?>
        <div class="bg-dark text-warning p-3 my-3 rounded-3" id="test" style="min-height:100px;"></div>
        <section class="container-fluid">
                <div class="container">
                        <div class="row g-5">
                                <div class="col-xx1-4 col-xl-4 col-lg-4 col-md-5 col-sm-12 col-xs-12 col-12">
                                        <aside class="row align-content-start py-3">
                                                <?php include "./View/Category/CategoryHeader.php"; ?>
                                                <?php include "./View/Category/CategoryList.php"; ?>
                                        </aside>
                                </div>
                                <div class="col-xx1-8 col-xl-8 col-lg-8 col-md-7 col-sm-12 col-xs-12 col-12">
                                        <main class="row align-content-start py-3">
                                                <?php include "./View/Content/ContentHeader.php"; ?>
                                                <?php include "./View/Content/ContentList.php"; ?>
                                        </main>
                                </div>
                        </div>
                </div>
        </section>
        <?php include "./View/Footer/Footer.php"; ?>
        <?php include "./View/Footer/Script.php"; ?>
</body>

</html>