<?php

namespace view;

class AlphabetView extends AbstractView {
    
    private array $letters;
    
    public function __construct(array $letters = null) {
        $this->letters = $letters;
    }

    public function generateHTML() {
        global $CONTENTS;

        $tableRowParams = [$CONTENTS => []];

        // Formiranje retka, u svakoj celiji je jedno slovo
        foreach ($this->letters as $alpha) {
            $pageLink = "index.php". "?". http_build_query(["letter" => $alpha]);
            $cellLink = create_element("a", ["href" => $pageLink, $CONTENTS => $alpha]);
            $tableCell = create_table_cell(["style" => "border-left:solid 1px;border-right:solid 1px;font-weight:bold;text-decoration:underline",
                                            $CONTENTS => $cellLink]);
            array_push($tableRowParams[$CONTENTS], $tableCell);
        }
        $tableRow = create_table_row($tableRowParams);

        $createTable = create_element("table", ["align" => "center", "style" => "font-size:20px;border-collapse:collapse",
                                                $CONTENTS => $tableRow], true);

        $divTable = create_element("div", ["style" => "width:100%;border-bottom:2px solid darkgrey;padding:35px 0;display:table",
                                            $CONTENTS => $createTable], true);
        echo $divTable;


    }

}
