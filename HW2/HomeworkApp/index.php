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

    echo create_element("h1", true, ["align" => "center", "contents" => "Homework"]);


    start_form("userInsideView.php", "post");

        echo create_input(["type" => "hidden", "name" => "formType", "value" => "login"]);

        $mail = create_input(["type" => "text", "name" => "mail"]);
        echo create_element("p", true, ["align" => "center", "contents" => ["E-mail: ", $mail]]);

        $password = create_input(["type" => "password", "name" => "password"]);
        echo create_element("p", true, ["align" => "center", "contents" => ["Lozinka: ", $password]]);

        $submitBtn = create_input(["type" => "submit", "value" => "Login"]);
        echo create_element("div", true, ["align" => "center", "contents" => $submitBtn]);

        $link = create_element("a",true, ["href" => "register.php", "title" => "register", "contents" => "create your account."]);
        echo create_element("p", true, ["align" => "center", "contents" => ["If you are new, please ", $link]]);

    end_form();

end_body();

end_html();
?>
