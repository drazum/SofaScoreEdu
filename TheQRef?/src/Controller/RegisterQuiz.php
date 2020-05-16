<?php

namespace Controller;

use View\WriteToFileView;

class RegisterQuiz implements Controller {

    public function display() {
        // Dohvadi ID trenutno aktivnog korisnika
        $user = new \Model\User();
        $user->load(\Session\Session::get("id"));

        // Id kviza koji se trenutno radi
        $quizID = \Dispatch\DefaultDispatcher::getInstance()->getMatchedRoute()->getParam("id");

        $quiz = new \RW\Quiz();
        $questions = $quiz->getQuizContent($user->id, $quizID);

        $view = new WriteToFileView("writetofile");
        $view->addParam("navigation_bar_view", "\View\NavigationBarView");
        $view->addParam("action", \Routing\Route::get("save")->generate(["id" => $quizID]));
        $view->addParam("file_content", __($questions));
        $view->addParam("back", \Routing\Route::get("create")->generate());
        $view->outputHTML();
    }

    /**
     * Metoda sprema kviz u koji se trenutno pise
     */
    public function save() {
        $user = new \Model\User();
        $user->load(\Session\Session::get("id"));

        $quizID = \Dispatch\DefaultDispatcher::getInstance()->getMatchedRoute()->getParam("id");

        $content = isset($_POST["new_text"]) ? $_POST["new_text"] : "";

        $quiz = new \RW\Quiz();
        $quiz->saveQuizContent($user->id, $quizID, $content);

        redirect(\Routing\Route::get("create")->generate());
    }
}
