<?php

namespace model;

abstract class AbstractModel {

    /**
     * Metoda vraca iz datoteke polje svih linija
     *
     * @return array
     */
    abstract public function getAll() : array ;

    /**
     * Metoda vraca iz datoteke liniju pod odredenim
     * identifikacijskim brojem
     *
     * @param string $id
     * @return mixed
     */
    abstract public function getById(string $id);
}
