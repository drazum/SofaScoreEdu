<?php

namespace controller;

abstract class AbstractController {

    /**
     * Metoda ispisuje pocetak i kraj nuznog html koda
     * za stranicu, te se unutar poziva metoda koja
     * obavlja dio koristan za aplikaciju
     */
    public function doAction() : void{
        global $CONTENTS;
        $CONTENTS = "contents";

        create_doctype();
        begin_html();

        begin_head();
        echo create_element("title", [$CONTENTS => "Movies"]);
        echo create_element("meta", ["charset" => "UTF-8"], false);
        end_head();

        begin_body();

        $this->doJob();

        end_body();
        end_html();
    }

    /**
     * Metoda koju koristi aplikacija za stvaranje
     * html elemenata koji formiraju stranicu
     */
    protected abstract function doJob() : void;
}
