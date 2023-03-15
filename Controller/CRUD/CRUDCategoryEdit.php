<?php

namespace Controller\CRUD;

use Controller\Constant;
use Controller\CRUD\CRUD;
use Controller\Utility\UPDATE;

class CRUDCategoryEdit extends CRUD
{
        private $table = Constant::TABEL["category"];
        private $values;
        private $execute;
        
        private function get__values()
        {
                return $this->values = "UPDATE {$this->database}.{$this->table} SET " . 
                        Constant::COLUMN["name"] . "=:name , " . 
                        Constant::COLUMN["category"]["parent"] . "=:category , " . 
                        Constant::COLUMN["update"] . "=:update WHERE " . 
                        Constant::COLUMN["id"] . " = :id";
        }

        private function get__execute()
        {
                $name = htmlentities($this->data["Name"]);
                $category = htmlentities($this->data["Parent"]);
                $update = date("Y-m-d H:i:s");
                $id = htmlentities($this->data["Number"]);
                return $this->execute = [":name"=>$name, ":category"=>$category, ":update"=>$update, ":id"=>$id];
        }

        use UPDATE;

}
