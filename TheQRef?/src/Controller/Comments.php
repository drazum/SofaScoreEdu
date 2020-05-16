<?php

namespace Controller;

use View\CommentsView;

class Comments implements Controller {
    private string $errorMessage;

    public function display() {
        $this->errorMessage = "";

        $quizID = \Dispatch\DefaultDispatcher::getInstance()->getMatchedRoute()->getParam("id");

        $quiz = new \Model\QuizInfo();
        $quiz->load($quizID);

        if(isset($_POST)) {
            $this->saveComment($quizID);
        }

        // Ucitavamo sve komentare iz baze za odredeni kviz
        $comments = $this->getAllComments($quizID);

        $view = new CommentsView("comments");
        $view->addParam("comment_route", \Routing\Route::get("comments")->generate(["id" => $quizID]));
        $view->addParam("comments_number", count($comments));
        $view->addParam("navigation_bar_view", "\View\NavigationBarView");
        foreach ($comments as $index=>$comment) {
            $c = __($comment->user_comment);
            $n = __($comment->user_name);
            $view->addParam("comment_".$index, $c);
            $view->addParam("user_".$index, $n);
        }
        $view->addParam("error_message", $this->errorMessage);
        $view->addParam("quiz_name", $quiz->name);
        $view->addParam("quiz_description", $quiz->description);
        $view->addParam("back", \Routing\Route::get("list")->generate());
        $view->outputHTML();
    }


    /**
     * Metoda obavlja spremanje komentara u bazu podataka
     *
     * @param string $quizID
     */
    private function saveComment(string $quizID): void {
        if(!isset($_POST["post_comment"]) || empty($_POST["post_comment"])) {
            $this->errorMessage = "Message cannot be empty! :)";
            return;
        }
        $userName = \Session\Session::get("name");
        $userSurname = \Session\Session::get("surname");

        $comment = new \Model\Comment();
        $comment->quiz_id = $quizID;
        $comment->user_name = $userName . " " . $userSurname;
        $comment->user_comment = $_POST["post_comment"];
        $comment->save();
        redirect(\Routing\Route::get("comments")->generate(["id" => $quizID]));
    }

    /**
     * Metoda vraca sve komentare iz baze podataka za odredeni kviz.
     *
     * @param string $quizID id kviza, ujedno strani kljuc za tablicu komentara
     * @return array polje svih komentara
     */
    private function getAllComments(string $quizID): array {
        $comment = new \Model\Comment();
        $allComments = $comment->loadAllByParam("WHERE quiz_id = ?", [$quizID]);
        return $allComments;
    }
}
