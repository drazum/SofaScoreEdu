<?php
require "libraries/htmllib.php";
require "functions.php";
session_start();

if(isset($_SESSION["user"])) {
    redirect("userInsideView.php");
}

create_doctype();
begin_html();

begin_head();
echo create_element('title', true, ['contents' => ["Homework app"]]);
end_head();

begin_body(["style" => "background-color:BurlyWood", "text" => "Navy"]);

    echo create_element("h1", true, ["align" => "center", "contents" => "Homework registration"]);

    start_form("userInsideView.php", "post");
        echo create_input(["type" => "hidden", "name" => "formType", "value" => "register"]);

        $firstName = create_input(["type" => "text", "name" => "firstName"]);
        echo create_element("p", true, ["align" => "center", "contents" => ["Ime: ", $firstName]]);

        $lastName = create_input(["type" => "text", "name" => "lastName"]);
        echo create_element("p", true, ["align" => "center", "contents" => ["Prezime: ", $lastName]]);

        $mail = create_input(["type" => "text", "name" => "mail"]);
        echo create_element("p", true, ["align" => "center", "contents" => ["E-mail: ", $mail]]);

        $password = create_input(["type" => "password", "name" => "password"]);
        echo create_element("p", true, ["align" => "center", "contents" => ["Lozinka: ", $password]]);


        $submitBtn = create_input(["type" => "submit", "value" => "Create"]);
        echo create_element("div", true, ["align" => "center", "contents" => $submitBtn]);

    end_form();

    start_form("index.php", "post");
        $backBtn = create_input(["type" => "submit", "value" => "Back"]);
        echo create_element("div", true, ["align" => "center", "contents" => $backBtn]);
    end_form();

end_body();

end_html();
?>
