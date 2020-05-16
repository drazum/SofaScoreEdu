<?php

namespace Model;

use DB\AbstractDBModel;

class Comment extends AbstractDBModel {

    public function getTable(): string {
        return "comments";
    }

    public function getPrimaryKeyColumn(): string {
        return "id";
    }

    public function getColumns(): array {
        return ["quiz_id", "user_name", "user_comment"];
    }
}
