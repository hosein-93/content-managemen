<header class="bg-dark" style="height:100px;">
        <section class="container h-100">
                <div class="row justify-content-center align-items-center h-100">
                        <div class="col-xx1-6 col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-12 col-12">
                                <form action="<?php echo Controller\Constant::URL . "/Controller/Exporter.php"; ?>" method="POST" name="Exporter" class="d-flex w-100" id="">
                                        <select name="Type" class="form-select form-select-sm shadow-none rounded-0 rounded-start" size="1" required="">
                                                <option value="0" > نوع خروجی را مشخص کنید ... </option>
                                                <option value="Text">TEXT</option>
                                                <option value="Csv">CSV</option>
                                                <option value="Word">WORD</option>
                                                <option value="Exel" selected>EXEL</option>
                                                <option value="Pdf">PDF</option>
                                                <option value="Json">JSON</option>
                                                <option value="JWT">JWT</option>
                                        </select>
                                        <button type="submit" name="Exporter-Submit" class="btn btn-primary rounded-0 rounded-end shadow-none">استخراج</button>
                                </form>
                        </div>
                </div>
        </section>

</header>