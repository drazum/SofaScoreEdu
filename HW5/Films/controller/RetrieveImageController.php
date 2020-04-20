<?php

namespace controller;

class RetrieveImageController extends AbstractController {

    private string $id;

    public function __construct(string $id) {
        $this->id = $id;
    }

    /**
     * Nadjacana metoda.
     * Preskacmo zapis pocetnih i konacnih html elemenata
     */
    public function doAction() : void {
        $this->doJob();
    }

    /**
     * Metoda dohvaca sliku s posluzitelja za prikaz klijentu
     */
    protected function doJob() : void{
        $modelFilm = new \model\Film();

        $movie = $modelFilm->getById($this->id);
        $fileType = $movie["cover_format"];

        $coverBLOB = $movie["cover"];

        $format = "Content-type: image/".$fileType;
        header($format);

        $im = imagecreatefromstring($coverBLOB);

        switch ($fileType) {
            case "jpg":
            case "jpeg":
                imagejpeg($im);
                break;
            case "png":
                imagepng($im);
                break;
            case "gif":
                imagegif($im);
                break;
            default:
                imagepng($im);
        }
        imagedestroy($im);
    }

}
