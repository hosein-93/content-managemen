<?php

namespace Controller\CRUD;

use Controller\CRUD\CRUD;

final class CRUD_DELETE extends CRUD
{
        public function set_sql($sql = '')
        {
                $this->sql = $sql;
        }

        public function set_execute($execute = [])
        {
                $this->execute = $execute;
        }
}
