<?php

namespace view;

class FilmTitleView extends AbstractView {

    /**
     *
     * @var \model\Film[]
     */
    private array $collection;

    public function __construct(array $collection) {
        $this->collection = $collection;
    }

    public function generateHTML() {
        global $CONTENTS;

        foreach ($this->collection as $film) {
            // Slika filma
            $url = "./index.php?action=get&id=" . $film["id"];
            $img = create_element("img", ["src" => $url, "style" => "width:214px;height:317px"], false);
            $divImage = create_element("div", ["style" => "width:100%;display:inline-block",
                                                $CONTENTS => $img], true);

            // Ime filma
            $title = $film["name"] . " (" . $film["year"] . ")";
            $italicTitle = create_element("i", [$CONTENTS => $title], true);
            $divTitle = create_element("div", ["style" => "width:100%;display:inline-block",
                                                $CONTENTS => $italicTitle], true);

            // Trajanje filma
            $duration = "Trajanje: " . $film["duration"] . " min";
            $italicDuration = create_element("i", [$CONTENTS => $duration], true);
            $divDuration = create_element("div", ["style" => "width:100%;display:inline-block",
                                                    $CONTENTS => $italicDuration], true);

            echo create_element("div", ["style" => "text-align:center;padding:30px 0",
                                        $CONTENTS => [$divImage, $divTitle, $divDuration]], true);
        }
    }

}
