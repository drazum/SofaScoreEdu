<?php

namespace Controller;

use View\StatisticsView;

class Statistics {

    public function display() {

        $quiz = new \RW\Quiz();
        // Dohvat svih id-eva mojih kvizova
        $myQuizIDs = $quiz->getAllUserQuizIDs(\Session\Session::get("id"));

        $quizInfo = new \Model\QuizInfo();
        // Dohvat svih id-eva kvizova drugih korisnika
        $otherQuizIDs = $quiz->getAllOtherQuizIDs(\Session\Session::get("id"));


        $view = new StatisticsView("statistics");
        $view->addParam("navigation_bar_view", "\View\NavigationBarView");
        foreach ($myQuizIDs as $index=>$quizID) {
            $quizInfo->load($quizID);
            $view->addParam("my_quiz_name_". $index, __($quizInfo->name));
            $view->addParam("max_".$index, $quiz->getMaxPoints($quizID));
            $view->addParam("min_".$index, $quiz->getMinPoints($quizID));
            $view->addParam("mean_".$index, $quiz->getMeanPoints($quizID));
            $view->addParam("std_dev_".$index, $quiz->getStandardDeviationPoints($quizID));
            $view->addParam("median_".$index, $quiz->getMedianPoints($quizID));
        }

        foreach ($otherQuizIDs as $index=>$quizID) {
            $quizInfo->load($quizID);
            $view->addParam("other_quiz_name_". $index, __(($quizInfo->name)) ?: "" );
            $view->addParam("other_max_".$index, $quiz->getMaxPoints($quizID));
            $view->addParam("other_min_".$index, $quiz->getMinPoints($quizID));
            $view->addParam("other_mean_".$index, $quiz->getMeanPoints($quizID));
            $view->addParam("other_std_dev_".$index, $quiz->getStandardDeviationPoints($quizID));
            $view->addParam("other_median_".$index, $quiz->getMedianPoints($quizID));
        }
        $view->addParam("iteration_number_me", count($myQuizIDs));
        $view->addParam("other_iteration_number", count($otherQuizIDs));
        $view->outputHTML();
    }
}

