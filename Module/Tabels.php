<?php

// $customerExample =
//         "CREATE TABLE customer (
//                 id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL UNIQUE,
//                 user_id INT UNSIGNED NOT NULL UNIQUE,
//                 name VARCHAR(255) NOT NULL DEFAULT 'Unknown',
//                 address TEXT,
//                 createAt DATETIME DEFAULT CURRENT_TIMESTAMP , 
//                 PRIMARY KEY ( id )
//                 FOREIGN KEY (user_id) REFERENCES invoice.user(id) , 
//         )";
// $Connection->exec("DROP TABLE IF EXISTS customer");
// $pdoConnection->exec($customerExample);

use Controller\Constant;

$category =
        "CREATE TABLE " . Constant::SERVER["database"] . "." . Constant::TABEL["category"] . " (
                " . Constant::COLUMN['id'] . " INT UNSIGNED AUTO_INCREMENT NOT NULL UNIQUE,
                " . Constant::COLUMN['name'] . " VARCHAR(255) NOT NULL UNIQUE,
                " . Constant::COLUMN['create'] . " DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL ,
                " . Constant::COLUMN['update'] . " DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL , 
                PRIMARY KEY (" . Constant::COLUMN['id'] . ")
        )";

$content =
        "CREATE TABLE " . Constant::SERVER["database"] . "." . Constant::TABEL["site"] . " (
                " . Constant::COLUMN['id'] . " INT UNSIGNED AUTO_INCREMENT NOT NULL UNIQUE,
                " . Constant::COLUMN['name'] . " VARCHAR(255) NOT NULL,
                " . Constant::COLUMN['site']['cat_id'] . " INT UNSIGNED NOT NULL,
                " . Constant::COLUMN['user'] . " VARCHAR(255) ,
                " . Constant::COLUMN['pass'] . " VARCHAR(255),
                " . Constant::COLUMN['description'] . " LONGTEXT,
                " . Constant::COLUMN['create'] . " DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL ,
                " . Constant::COLUMN['update'] . " DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL , 
                PRIMARY KEY (" . Constant::COLUMN['id'] . "),
                FOREIGN KEY (" . Constant::COLUMN['site']['cat_id'] . ") REFERENCES " . Constant::SERVER["database"] . "." . Constant::TABEL["category"] . "(" . Constant::COLUMN['id'] . ")
        )";

$connection->exec("DROP TABLE IF EXISTS " . Constant::SERVER["database"] . "." . Constant::TABEL["site"]);
$connection->exec("DROP TABLE IF EXISTS " . Constant::SERVER["database"] . "." . Constant::TABEL["category"]);
$connection->exec($category);
$connection->exec($content);
