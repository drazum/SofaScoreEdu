<?php
require "functions.php";
require "libraries/htmllib.php";

session_start();

if(!isset($_SESSION["user"])) {
    $error = false;
    $formType = $_POST["formType"];

    // Ako nisu ispunjena polja
    foreach($_POST as $key => $value) {
        if (!isset($_POST[$key]) || empty($_POST[$key]) ) {
            $error = true;
        }
    }

    if(!$error) {
        // ako nema errora izvrsi akciju ovisno o formi koja je zvala
        $userExists = isLoggedIn();

        if($formType === "login") {
            if(!$userExists) {
                $error = true;
                redirect("index.php");
            } else {
                $error = false;
                //ULOGIRAN
            }
        } else if($formType === "register") {
            if($userExists) {
                $error = true;
            } else {
                // Registriraj korisnika ako nema gresaka kod upisa
                registerUser();
                // Dodijeljujm vrijednost e-maila jer to
                // koristim kao referencu za povlacenje podataka
                $_SESSION["user"] = $_POST["mail"];
                $error = false;
            }

        } else {
            $error = true;
        }
    }

    // Ako ima prisutnih gresaka, vrati na formu koja je zvala
    if($error && count($_POST) != 0) {
        $error = false;
        redirect($formType === "login" ? "index.php" : "register.php" );
    }

}

// ucitaj podatke za korisnika i studenta pod njegovim id-em
[$userID, $firstName,$lastName, $mail, $password ] = getUserData($_SESSION["user"]);
[$hwID, $studentID, $fileName, $score] = getStudentData($userID);

$helloString = "Dobar dan ".__($firstName)." ".__($lastName).", kako smo?";
create_doctype();
begin_html();

begin_head();
    echo create_element('title', true, ['contents' => ["Homework app"]]);
end_head();

begin_body(["style" => "background-color:BurlyWood", "text" => "Navy"]);

    echo create_element("h1", true, ["align" => "center", "contents" => "Homework"]);
    echo create_element("h3", true, ["contents" => $helloString]);



    start_form("dataLoad.php", "post", "multipart/form-data");

        echo create_input(["type" => "hidden", "name" => "firstName", "value" => $firstName]);
        echo create_input(["type" => "hidden", "name" => "lastName", "value" => $lastName]);
        echo create_input(["type" => "hidden", "name" => "mail", "value" => $mail]);
        echo create_input(["type" => "hidden", "name" => "id", "value" => $userID]);

        $data = create_input(["type" => "file", "name" => "document"]);
        echo create_element("label", true, ["contents" => "Datoteka: $data"]);
        if ( empty($hwID)) {
            echo create_input(["type" => "submit", "name" => "posalji"]);
        } else {
            echo create_element("p", true, ["contents" => "Vec ste predali zadacu"]);
        }


    end_form();

end_body();

end_html();
?>
