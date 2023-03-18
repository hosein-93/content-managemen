<?php

namespace Controller\CRUD;

use Controller\Constant;
use Controller\CRUD\CRUD;
use Controller\Utility\SELECT;

class CRUDCategorySelect extends CRUD
{
        private $table = Constant::TABEL["category"];
        private $values;
        private $distinct;
        private $where;

        public function get_values()
        {
                $this->values = "SELECT * FROM {$this->database}.{$this->table} ORDER BY " . Constant::COLUMN["id"] . " DESC";
                return $this->values;
        }

        public function get_distinct()
        {
                $this->distinct = "SELECT DISTINCT " . Constant::COLUMN["name"] . " FROM {$this->database}.{$this->table} ORDER BY " . Constant::COLUMN["name"] . " ASC";
                return $this->distinct;
        }

        public function get_where()
        {
                $this->where = "SELECT * FROM {$this->database}.{$this->table} WHERE ";
                return $this->where;
        }

        use SELECT;
}
