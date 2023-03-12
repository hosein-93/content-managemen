<?php

?>

<header class="bg-dark" style="height:100px;">
                <section class="container h-100">
                        <div class="row justify-content-center align-items-center h-100">
                                <div class="col-xx1-6 col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-12 col-12">
                                        <form action="#" method="POST" name="Exporter-Form" class="d-flex w-100" id="">
                                                <select name="Exporter-Type" class="form-select form-select-sm shadow-none rounded-0 rounded-start" size="1" required="">
                                                        <option selected=""> نوع خروجی را مشخص کنید ... </option>
                                                        <option value="Txt">TEXT</option>
                                                        <option value="Csv">CSV</option>
                                                        <option value="Excel">EXCEL</option>
                                                        <option value="Pdf">PDF</option>
                                                        <option value="Json">JSON</option>
                                                        <option value="JWT">JWT</option>
                                                </select>
                                                <button type="submit" name="Exporter-Submit" class="btn btn-primary rounded-0 rounded-end">استخراج</button>
                                        </form>
                                </div>
                        </div>
                </section>
                
        </header>