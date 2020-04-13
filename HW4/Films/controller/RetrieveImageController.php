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

        // Dohvati elemente filma pod primljenim identifikacijskim brojem
        $movie = $modelFilm->getById($this->id);
        // Ekstrahiraj ekstenziju slike
        preg_match("@.*\.([a-zA-Z0-9]+)$@", $movie["cover"], $match);
        $fileType = $match[1];

        // Putanja do datoteke na posluzitelju
        $coverPath = $movie["cover"];

        $format = "Content-type: image/".$fileType;
        header($format);

        switch ($fileType) {
            case "jpg":
            case "jpeg":
                $im = imagecreatefromjpeg($coverPath);
                imagejpeg($im);
                break;
            case "png":
                $im = imagecreatefrompng($coverPath);
                imagepng($im);
                break;
            case "gif":
                $im = imagecreatefromgif($coverPath);
                imagegif($im);
                break;
            default:
                $im = imagecreatefrompng($coverPath);
                imagepng($im);
        }
        imagedestroy($im);
    }

}
