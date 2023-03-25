<?php

namespace Controller;

class Constant
{
        const URL = "http://localhost/script.ac/Site-Management";
        const URL_PATH = "C:/xampp/htdocs/script.ac/Site-Management";
        const SERVER = [
                "host" => "localhost", "username" => "root", "password" => "", "rdbms" => "mysql", "database" => "site_management", "charset" => "utf8mb4"
        ];
        const TABEL = ["category" => "category", "site" => "content"];
        const COLUMN = [
                "id" => "id", "name" => "name", "create" => "create_at", "update" => "update_at", "user" => "username", "pass" => "password", "description" => "description",
                "site" => ["cat_id" => "category_id"]
        ];
        const FORM = ["status", "form", "Name", "Parent", "Number", "Submit", "Category", "UserName", "Password", "Description"];
        const JWT_VALUES = ['key' => 'site management', 'algorithm' => 'HS256'];
        const RESOURCE = ['folder' => 'CrawlerResult'];
        const EXPORTER_FILE = "ExporterFile/";
}
