<?php

namespace Controller\CRUD;
use Controller\CRUD\CRUD;
class CRUDContentEdit extends CRUD
{
        public function get_key()
        {
                return $this->data["form"];
        }
}
