<?php

include '../autoLoader.php';



parse_str($_REQUEST["data"], $formInformation);
echo "<pre>";
var_dump($formInformation);
echo "</pre>";