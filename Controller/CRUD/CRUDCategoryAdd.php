<?php

namespace Controller\CRUD;

use Controller\Constant;
use Controller\CRUD\CRUD;
use Controller\Utility\INSERT;

final class CRUDCategoryAdd extends CRUD
{
        private $table = Constant::TABEL["category"];
        private $values;
        private $execute;

        public function get_values()
        {
                $this->values = "INSERT INTO {$this->database}.{$this->table} 
                        ( " . Constant::COLUMN["name"] . "," . Constant::COLUMN["category"]["parent"] . "," . Constant::COLUMN["update"] . ") 
                        VALUES (:name, :parent, :update)";
                return $this->values;
        }
        public function get_execute()
        {
                $name = htmlentities($this->data["Name"]);
                $parent = htmlentities($this->data["Parent"]);
                $update = date("Y-m-d H:i:s");
                $this->execute = [":name" => $name, ":parent" => $parent, ":update" => $update];
                return $this->execute;
        }

        use INSERT;
}
