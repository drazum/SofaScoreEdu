<?php

namespace Controller;

use View\RegisterView;

class Account implements Controller {
    private string $errorMessage;

    public function display() {
        $this->errorMessage = "";

        if(isPost()) {
            $this->passwordChange();
        }

        $user = new \Model\User();
        $user->load(\Session\Session::get("id"));

        // Nova instanca RegisterView-a koji nasljeduje glavni
        // razred za upravljanje template-ima
        $view = new RegisterView("account");

        // Dodaju se parametri za svaki dio meta jezika u html datoteci.
        // Za vise vidjeti src\View\View.php
        $view->addParam("navigation_bar_view", "\View\NavigationBarView");
        $view->addParam("user_date_of_birth", __($user->date_of_birth));
        $view->addParam("user_email", __($user->email));
        $view->addParam("user_password", __($user->password));
        $view->addParam("pw_change", \Routing\Route::get("account")->generate());
        $view->addParam("error_message", $this->errorMessage);
        $view->outputHTML();
    }

    /**
     * Metoda se poziva kod promjene lozinke.
     * Izvrsavaju se provjere da li su sva polja ispunjena i
     * da li se lozinke podudaraju.
     */
    private function passwordChange(): void {
        if(!post("old_pw") || !post("new_pw") || !post("repeat_pw")){
            $this->errorMessage .= "Fill all the boxes. ";
            return;
        }

        $user = new \Model\User();
        $user->load(\Session\Session::get("id"));

        $realOldPw = $user->password;
        $oldPw = sha1(post("old_pw"));

        if ($oldPw !== $realOldPw) {
            $this->errorMessage .= "Wrong old password. ";
            return;
        }
        if(post("new_pw") !== post("repeat_pw")) {
            $this->errorMessage .= "New password and repeated password do not match";
            return;
        }

        $user->password = sha1(post("new_pw"));
        $user->save();
        $this->errorMessage = "Password changed successfully!";
    }
}
