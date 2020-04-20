<?php


namespace view;


class LogoutHeaderView extends AbstractView {
    private string $firstName;
    private string $lastName;

    public function __construct(string $firstName = "", string $lastName = "") {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function generateHTML() {
        global $CONTENTS;

        $backBtn = create_input(["type" => "button", "value" => "Logout", "style" => "font-size:200px;width:200px"]);
        $link = create_element("a", ["href" => "./index.php?action=logout", $CONTENTS => $backBtn], true);
        echo create_element("div", ["align" => "center", "style" => "padding:30px", $CONTENTS => $link], true);

    }
}