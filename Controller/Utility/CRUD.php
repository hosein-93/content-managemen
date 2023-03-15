<?php

namespace Controller\Utility;

use Controller\Constant;

trait DB_CONNECT
{
        private $connection;
        private $database = Constant::SERVER["database"];
}

trait INSERT
{
        use DB_CONNECT;

        protected $data;

        public function __construct($data)
        {
                $this->data = $data;
                global $connection;
                $this->connection = $connection;
        }

        abstract private function set__execute();
        abstract private function get__execute();

        public function CRUD()
        {
                $sql = "INSERT INTO {$this->database}.{$this->table} {$this->values}";
                $stm = $this->connection->prepare($sql);
                $stm->execute($this->get__execute());
                $result =  $this->connection->lastInsertId();
                return $result;
        }
}

trait UPDATE
{
        use DB_CONNECT;

        protected $data;

        public function __construct($data)
        {
                $this->data = $data;
                global $connection;
                $this->connection = $connection;
        }

        abstract private function get__values();
        abstract private function get__execute();

        public function CRUD()
        {
                $sql = $this->get__values();
                $stmt = $this->connection->prepare($sql);
                $stmt->execute($this->get__execute());
                $result = $stmt->rowCount();
                return $result;
        }
}
trait DELETE
{
        public function CRUD()
        {
                // global $pdoConnection, $db, $dbTables, $userInformation;
                // $sql = "DELETE FROM  invoice.user WHERE id=1";
                // $stmt = $pdoConnection->prepare($sql);
                // $stmt->execute();
                // $result = $stmt->rowCount();
                // return $result;
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

        abstract private function get__values();

        public function CRUD()
        {
                $sql = $this->get__values();
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
        }

        public function CRUD_DISTINCT()
        {
                $sql = $this->get__valuesDistinct();
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
        }
}