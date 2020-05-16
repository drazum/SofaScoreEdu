<?php

namespace Model;

use DB\AbstractDBModel;

class User extends AbstractDBModel{

    public function getTable(): string {
        return "users";
    }

    public function getPrimaryKeyColumn(): string {
        return "id";
    }

    public function getColumns(): array {
        return ["name", "surname", "date_of_birth", "email", "password"];
    }
}