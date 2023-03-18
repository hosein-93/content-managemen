<?php

namespace Controller\Utility;

use Controller\Constant;

trait CRUD
{
        protected $connection;
        protected $database = Constant::SERVER["database"];
        protected $data;

        abstract public function set_data();
        abstract public function get_data();

        abstract protected function set_table();
        abstract public function get_table();

        abstract public function set_sql($execute);
        abstract public function get_sql();

        abstract public function set_execute($execute);
        abstract public function get_execute();

        public function INSERT()
        {
                $sql = $this->get_sql();
                $stmt = $this->connection->prepare($sql);
                $stmt->execute($this->get_execute());
                $result =  $this->connection->lastInsertId();
                return $result;
        }

        public function UPDATE()
        {
                $sql = $this->get_sql();
                $stmt = $this->connection->prepare($sql);
                $stmt->execute($this->get_execute());
                $result = $stmt->rowCount();
                return $result;
        }

        public function DELETE()
        {
                $sql = $this->get_sql();
                $stmt = $this->connection->prepare($sql);
                $stmt->execute($this->get_execute());
                $result = $stmt->rowCount();
                return $result;
        }

        public function SELECT()
        {
                $sql = $this->get_sql();
                $stmt = $this->connection->prepare($sql);
                $stmt->execute($this->get_execute());
                $result = $stmt->fetchAll();
                return $result;
        }

}
