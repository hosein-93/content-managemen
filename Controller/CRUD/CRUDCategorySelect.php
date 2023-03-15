<?php

namespace Controller\CRUD;

use Controller\Constant;
use Controller\CRUD\CRUD;
use Controller\Utility\SELECT;

class CRUDCategorySelect extends CRUD
{
        private $table = Constant::TABEL["category"];
        private $values;
        private $valuesDistinct;

        private function get__values()
        {
                return $this->values = "SELECT * FROM {$this->database}.{$this->table} ORDER BY " . Constant::COLUMN["name"] . " ASC";
        }

        private function get__valuesDistinct()
        {
                return $this->valuesDistinct = "SELECT DISTINCT " . Constant::COLUMN["name"] . " FROM {$this->database}.{$this->table} ORDER BY " . Constant::COLUMN["name"] . " ASC";
        }

        use SELECT;
}
