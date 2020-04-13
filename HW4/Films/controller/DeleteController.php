<?php

namespace controller;

class DeleteController extends AbstractController {

    private string $id;

    public function __construct(string $id) {
        $this->id = $id;
    }

    /**
     * Nadjacana metoda.
     * Preskacmo zapis pocetnih i konacnih html elemenata
     */
    public function doAction() : void{
        $this->doJob();
    }

    /**
     * Metoda brise film i osvjezava stranicu
     */
    protected function doJob() : void{
        $modelFilm = new \model\Film();

        $modelFilm->deleteMovie($this->id);

        redirect("./index.php?action=add");
    }
}
