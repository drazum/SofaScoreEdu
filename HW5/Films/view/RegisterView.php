<?php


namespace view;


class RegisterView extends AbstractView {

    public function generateHTML() {
        global $CONTENTS;

        start_form("./index.php?action=register", "post");

        $firstName = create_input(["type" => "text", "name" => "firstName"]);
        echo create_element("p", ["align" => "center", $CONTENTS => ["First name: ", $firstName]], true);

        $lastName = create_input(["type" => "text", "name" => "lastName"]);
        echo create_element("p", ["align" => "center", $CONTENTS => ["Last name: ", $lastName]], true);

        $username = create_input(["type" => "text", "name" => "username"]);
        echo create_element("p", ["align" => "center", $CONTENTS => ["Username: ", $username]], true);

        $password = create_input(["type" => "password", "name" => "password"]);
        echo create_element("p", ["align" => "center", $CONTENTS => ["Password: ", $password]], true);

        $submitBtn = create_input(["type" => "submit", "value" => "Submit"]);
        echo create_element("div", ["align" => "center", $CONTENTS => $submitBtn], true);

        $backBtn = create_input(["type" => "button", "value" => "Start page"], false);
        $link = create_element("a", ["href" => "./index.php", $CONTENTS => $backBtn], true);
        echo create_element("div", ["align" => "center", $CONTENTS => $link], true);


        end_form();
    }
}