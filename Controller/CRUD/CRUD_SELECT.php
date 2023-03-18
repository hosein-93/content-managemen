<?php

namespace Controller\CRUD;

use Controller\CRUD\CRUD;

class CRUD_SELECT extends CRUD
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
