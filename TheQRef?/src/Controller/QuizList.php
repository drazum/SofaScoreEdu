<?php

namespace Controller;

use View\QuizListView;

class QuizList implements Controller {
    public function display() {

        // Objekt za spremanje u pitanja kvizova u datoteke
        $quiz = new \RW\Quiz();
        $myQuizIDs = $quiz->getAllUserQuizIDs(\Session\Session::get("id"));
        // Model povezan s bazom koja sadrzi openite informacije o kvizovima
        $quizInfo = new \Model\QuizInfo();
        $otherQuizIDs = $quiz->getAllOtherQuizIDs(\Session\Session::get("id"));


        $view = new QuizListView("quizlist");
        $view->addParam("navigation_bar_view", "\View\NavigationBarView");
        foreach ($myQuizIDs as $index=>$quizID) {
            $quizInfo->load($quizID);
            $view->addParam("me_". $index, __($quizInfo->name));
            $view->addParam("comments_".$index, \Routing\Route::get("comments")->generate(["id" => $quizID]));
            $view->addParam("edit_".$index, \Routing\Route::get("write")->generate(["id" => $quizID]));
            $view->addParam("delete_".$index, \Routing\Route::get("write")->generate(["id" => $quizID]));
        }

        foreach ($otherQuizIDs as $index=>$quizID) {
            $quizID = $quizID;
            $quizInfo->load($quizID);
            $view->addParam("other_". $index, __($quizInfo->name));
            $view->addParam("comments_others_".$index, \Routing\Route::get("comments")->generate(["id" => $quizID]));
            $view->addParam("edit_others_".$index, \Routing\Route::get("write")->generate(["id" => $quizID]));
            $view->addParam("delete_others_".$index, \Routing\Route::get("write")->generate(["id" => $quizID]));
        }


        $view->addParam("iteration_number_me", count($myQuizIDs));
        $view->addParam("iteration_number_others", count($otherQuizIDs));
        $view->outputHTML();
    }
}
