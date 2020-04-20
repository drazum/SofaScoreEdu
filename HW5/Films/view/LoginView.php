<?php


namespace view;


class LoginView extends AbstractView {

    public function generateHTML() {
        global $CONTENTS;

        start_form("./index.php?action=login", "post");

        $username = create_input(["type" => "text", "name" => "username"]);
        echo create_element("p", ["align" => "center", $CONTENTS => ["Username: ", $username]], true);

        $password = create_input(["type" => "password", "name" => "password"]);
        echo create_element("p", ["align" => "center", $CONTENTS => ["Password: ", $password]], true);

        $submitBtn = create_input(["type" => "submit", "value" => "Submit"]);
        echo create_element("div", ["align" => "center", $CONTENTS => $submitBtn], true);

        $backBtn = create_input(["type" => "button", "value" => "Start page"]);
        $link = create_element("a", ["href" => "./index.php", $CONTENTS => $backBtn], true);
        echo create_element("div", ["align" => "center", $CONTENTS => $link], true);

        $registerLink = "./index.php?action=register";
        $link = create_element("a", ["href" => $registerLink, "title" => "register", $CONTENTS => "create your account."], true);
        echo create_element("p", ["align" => "center", $CONTENTS => ["If you are new, please ", $link]], true);

        end_form();
    }
}