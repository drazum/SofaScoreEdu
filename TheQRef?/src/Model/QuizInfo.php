<?php

namespace Model;

use DB\AbstractDBModel;

class QuizInfo extends AbstractDBModel {

    public function getTable(): string {
        return "quizzes";
    }

    public function getPrimaryKeyColumn(): string {
        return "id";
    }

    public function getColumns(): array {
        return ["name", "description", "is_public", "enable_comments"];
    }
}
