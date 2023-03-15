<?php

namespace Controller\CRUD;
use Controller\CRUD\CRUD;
class CRUDContentAdd extends CRUD
{
        public function get_key()
        {
                return $this->data["form"];
        }
}
