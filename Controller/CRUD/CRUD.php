<?php

namespace Controller\CRUD;

use Controller\Constant;
use Controller\Utility\CRUD as Trait_CRUD;

abstract class CRUD
{
        use Trait_CRUD;

        protected $table;
        protected $sql;
        protected $execute;

        public function set_data($data = null)
        {
                $this->data = $data;
                global $connection;
                $this->connection = $connection;
        }

        public function get_data()
        {
                return $this->data;
        }


        protected function set_table()
        {
                $this->table = $this->database . "." . Constant::TABEL["category"];
        }

        public function get_table()
        {
                $this->set_table();
                return $this->table;
        }

        public function get_sql()
        {
                return $this->sql;
        }
        public function get_execute()
        {
                return $this->execute;
        }
}
