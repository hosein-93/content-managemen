<?php

namespace Controller\Utility;

use Controller\Constant;

trait DB_CONNECT
{
        private $connection;
        private $database = Constant::SERVER["database"];
}

trait GET_DATA
{
        protected $data;
        public function __construct($data)
        {
                $this->data = $data;
                global $connection;
                $this->connection = $connection;
        }
}

trait INSERT
{
        use DB_CONNECT, GET_DATA;

        abstract public function get_values();
        abstract public function get_execute();

        public function CRUD()
        {
                $sql = $this->get_values();
                $stm = $this->connection->prepare($sql);
                $stm->execute($this->get_execute());
                $result =  $this->connection->lastInsertId();
                return $result;
        }
}

trait UPDATE
{
        use DB_CONNECT, GET_DATA;

        abstract public function get_values();
        abstract public function get_execute();

        public function CRUD()
        {
                $sql = $this->get_values();
                $stmt = $this->connection->prepare($sql);
                $stmt->execute($this->get_execute());
                $result = $stmt->rowCount();
                return $result;
        }
}
trait DELETE
{

        abstract public function get_values();
        abstract public function get_execute();

        public function CRUD()
        {
                $sql = $this->get_values();
                $stmt = $this->connection->prepare($sql);
                $stmt->execute($this->get_execute());
                $result = $stmt->rowCount();
                return $result;
        }
}
trait SELECT
{
        use DB_CONNECT;

        public function __construct()
        {
                global $connection;
                $this->connection = $connection;
        }

        abstract public function get_values();
        abstract public function get_distinct();
        abstract public function get_where();

        public function CRUD()
        {
                $sql = $this->get_values();
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
        }

        public function DISTINCT()
        {
                $sql = $this->get_distinct();
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
        }

        public function WHERE($where)
        {
                $sql = $this->get_where() . $where;
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
        }
}


