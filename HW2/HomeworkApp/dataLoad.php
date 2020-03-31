<?php
require "libraries/htmllib.php";
require "functions.php";

if(isset($_FILES["document"])) { 
    $docName = $_FILES["document"]["name"];
    $docExtension = explode(".", $docName)[1];

    $upload_dir = "uploads/";
    $newFileName = $upload_dir . "HW_" . $_POST["firstName"] . "_" . $_POST["lastName"] . "." . $docExtension;

    if(move_uploaded_file($_FILES["document"]["tmp_name"], $newFileName)) {
        $feedback = "Datoteka uspjesno prebacena";

        // Zapisi studenta u datoteku
        $file = fopen("homeworks.txt", "a+");
        $string = setUserID().";".$_POST["id"].";".$newFileName.";"."uPostupku";
        fwrite($file, $string."\n");
        fclose($file);

    } else {
        $feedback = "Datoteka nije prebacena";
    }
}

create_doctype();
begin_html();

begin_head();
    echo create_element('title', true, ['contents' => ["Homework app"]]);
end_head();


begin_body(["style" => "background-color:BurlyWood", "text" => "Navy"]);

    echo create_element("h2", true, ["align" => "center", "contents" => $feedback]);


    start_form("userInsideView.php", "post");

        // back gumb za vracanje na glavni izbornik
        $backBtn = create_input(["type" => "submit", "value" => "Back"]);
        echo create_element("div", true, ["align" => "center", "contents" => $backBtn]);

    end_form();

end_body();

end_html();
?>
