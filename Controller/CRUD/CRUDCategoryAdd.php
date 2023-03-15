<?php

namespace Controller\CRUD;

use Controller\Constant;
use Controller\CRUD\CRUD;
use Controller\Utility\INSERT;

final class CRUDCategoryAdd extends CRUD
{
        private $table = Constant::TABEL["category"];
        private $values = "(" . Constant::COLUMN["name"] . "," . Constant::COLUMN["category"]["parent"] . "," . Constant::COLUMN["update"] . ") 
                                        VALUES (:name, :parent, :update)";
        private $execute;

        private function set__execute()
        {
                $name = htmlentities($this->data["Name"]);
                $parent = htmlentities($this->data["Parent"]);
                $update = date("Y-m-d H:i:s");
                $this->execute = [":name" => $name, ":parent" => $parent, ":update" => $update];
        }
        private function get__execute()
        {
                $this->set__execute();
                return $this->execute;
        }

        use INSERT;
}
