<?php

namespace Controller;

use View\CreateQuizView;

class CreateQuiz implements Controller {
    private string $errorMessage;

    public function display() {
        $this->errorMessage = "";

        if(isPost()) {
            $this->quizInfoCheck();
        }

        $view = new CreateQuizView("createquiz");
        $view->addParam("navigation_bar_view", "\View\NavigationBarView");
        $view->addParam("create_and_next", \Routing\Route::get("create")->generate());
        $view->addParam("write_to_file", \Routing\Route::get("write")->generate(["id" => "1"]));
        $view->addParam("error_message", $this->errorMessage);
        $view->outputHTML();
    }

    /**
     * Metoda provjerava unesene podatke za kviz i puni poruku greske.
     */
    private function quizInfoCheck(): void {

        if(!post("name")) {
            $this->errorMessage .= "Quiz name is missing. ";
        }

        if (!post("description")) {
            $this->errorMessage .= "Quiz description is missing. ";
        }

        if(empty($this->errorMessage)) {
            $quizInfo = new \Model\QuizInfo();
            $quizInfo->name = post("name");
            $quizInfo->description = post("description");
            $quizInfo->is_public = isPost("is_public") ? 1 : 0;
            $quizInfo->enable_comments = isPost("enable_comments") ? 1 : 0;
            $quizInfo->save();

            $quizID = $quizInfo->getPrimaryKey();
            $quiz = new \RW\Quiz();
            $quiz->simulatePoints($quizID);

            redirect(\Routing\Route::get("write")->generate(["id" => $quizInfo->getPrimaryKey()]));
        }
    }
}
