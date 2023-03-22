<header class="bg-dark" style="height:100px;">
        <section class="container h-100">
                <div class="row justify-content-center align-items-center h-100">
                        <div class="col-xx1-6 col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-12 col-12">
                                <form action="#" method="POST" name="Exporter" class="d-flex w-100" id="" onsubmit="exporter(event);">
                                        <select name="Type" class="form-select form-select-sm shadow-none rounded-0 rounded-start" size="1" required="">
                                                <option value="0" > نوع خروجی را مشخص کنید ... </option>
                                                <option value="Text">TEXT</option>
                                                <option value="Csv">CSV</option>
                                                <option value="Excel">EXCEL</option>
                                                <option value="Pdf">PDF</option>
                                                <option value="Json">JSON</option>
                                                <option value="JWT" selected>JWT</option>
                                        </select>
                                        <button type="submit" name="Exporter-Submit" class="btn btn-primary rounded-0 rounded-end">استخراج</button>
                                </form>
                        </div>
                </div>
        </section>

</header>
<div id="test"></div>