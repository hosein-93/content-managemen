<?php

namespace Controller\CRUD;

use Controller\Constant;
use Controller\CRUD\CRUD;
use Controller\Utility\INSERT;

final class CRUDCategoryDelete extends CRUD
{
        private $table = Constant::TABEL["category"];
        private $values;
        private $execute;

        public function get_values()
        {
                $this->values = "DELETE FROM {$this->database}.{$this->table} WHERE " 
                . Constant::COLUMN["id"] . "=:id";
                return $this->values;
        }
        public function get_execute()
        {
                $id = htmlentities($this->data["Number"]);
                $this->execute = [":id" => $id];
                return $this->execute;
        }

        use INSERT;
}
