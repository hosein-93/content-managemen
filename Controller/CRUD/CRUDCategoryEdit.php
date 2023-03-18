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

        public function get_values()
        {
                $this->values = "UPDATE {$this->database}.{$this->table} SET "
                        . Constant::COLUMN["name"] . "=:name , "
                        . Constant::COLUMN["update"] . "=:update WHERE "
                        . Constant::COLUMN["id"] . " = :id ";
                return $this->values;
        }

        public function get_execute()
        {
                $name = htmlentities($this->data["Name"]);
                $update = date("Y-m-d H:i:s");
                $id = htmlentities($this->data["Number"]);
                $this->execute = [":name" => $name, ":update" => $update, ":id" => $id];
                return $this->execute;
        }

        use UPDATE;
}
