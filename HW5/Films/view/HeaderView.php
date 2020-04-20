<?php

namespace view;

class HeaderView extends AbstractView {

    private string $title;
    private bool $isBack;

    public function __construct(string $title, bool $isBack = false) {
        $this->title = $title;
        $this->isBack = $isBack;
    }

    public function generateHTML() {
        global $CONTENTS;

        $hrefMovieSymbol = "./index.php";
        $srcMovieSymbol = "./resources/movies.png";

        if($this->isBack) {
            $hrefRightSymbol = "./index.php";
            $srcRightSymbol = "./resources/back.png";
        } else {
            $hrefRightSymbol = "./index.php?action=add";
            $srcRightSymbol = "./resources/add.png";
        }

        // Left linkable image for main page
        $logoImg = create_element("img", ["src" => $srcMovieSymbol,
                                            "style" => "width:128px;height:128px"], false);
        $logoImgLink = create_element("a", ["href" => $hrefMovieSymbol,
                                            $CONTENTS => $logoImg], true);
        $divLogo = create_element("div", ["style" => "display:inline-block;float:left",
                                            $CONTENTS => $logoImgLink], true);

        // Title in the middle.
        $title = create_element("h2", [$CONTENTS => $this->title], true);
        $divTitle = create_element("div", ["style" => "margin:32px;display:inline-block",
                                            $CONTENTS => $title], true);

        // Right linkable image for adding a movie.
        $addImg = create_element("img", ["src" => $srcRightSymbol], false);
        $addImgLink = create_element("a", ["href" => $hrefRightSymbol,
                                            $CONTENTS => $addImg], true);
        $divAdd = create_element("div", ["style" => "display:inline-block;float:right",
                                                $CONTENTS => $addImgLink], true);


        echo create_element("div", ["style" => "text-align:center;overflow:hidden;width:100%;border-bottom:2px solid darkgrey",
                                    $CONTENTS => [$divLogo, $divTitle, $divAdd]]);

    }

}
