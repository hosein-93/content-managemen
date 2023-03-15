<?php

use Controller\Constant;

date_default_timezone_set("Asia/Tehran");

try {
        // $connection = new PDO("mysql:host=localhost;dbname=databasename;charset=utf8mb4", "root", "");
        $connection = new PDO(
                Constant::SERVER["rdbms"]
                        . ":host=" . Constant::SERVER["host"]
                        . ";dbname=" . Constant::SERVER["database"]
                        . ";chars=" . Constant::SERVER["charset"],
                Constant::SERVER["username"],
                Constant::SERVER["password"]
        );
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $Message = "Connect to the database successfully";
} catch (PDOException $error) {
        $Message = "PDO ERROR : Failed to connect. " . $error->getMessage() . "in line " . $error->getLine();
}


