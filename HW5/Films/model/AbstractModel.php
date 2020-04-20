<?php

namespace model;

abstract class AbstractModel {

    /**
     * Metoda vraca iz baze podataka cijelu tablicu
     *
     * @return array
     */
    abstract public function getAll() : array;

    /**
     * Metoda vraca iz baze podataka redak koji
     * ima uneseni identifikacijski broj
     *
     * @param string $id
     * @return mixed
     */
    abstract public function getById(string $id);
}
