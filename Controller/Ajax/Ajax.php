<?php 

namespace Controller\Ajax;

parse_str($_REQUEST["data"], $formInformation);
echo "<pre>";
var_dump($formInformation);
echo "</pre>";
