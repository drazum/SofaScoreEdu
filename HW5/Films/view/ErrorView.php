<?php

namespace view;

class ErrorView extends AbstractView {

    private string $message;
    private bool $search;

    public function __construct(string $message, bool $search) {
        $this->search = $search;
        $this->message = $message;
    }

    public function generateHTML() {
        global $CONTENTS;

        if($this->search){
            $imgSrc = "./resources/notfound.png";
        } else{
            $imgSrc = "./resources/error.png";
        }

        $errorImg = create_element("img", ["src" => $imgSrc,
                                            "style" => "width:64px;height:64px"], false);
        $text = create_element("h4", [$CONTENTS => $this->message], true);

        $divError = create_element("div", ["style" => "padding:5px;text-align:center",
                                            $CONTENTS => [$errorImg, $text]], true);
        echo $divError;
    }

}
