<?php

namespace DB;

abstract class AbstractDBModel implements DBModel {

    /**
     * Primarni ključ.
     * @var mixed
     */
    private $pk;

    /**
     * Redak tablice. Podaci modela.
     * @var mixed
     */
    private $data;

    /**
     * Spremanje novog podatka ili osvježavanje postojećeg.
     */
    public function save() {
        $columns = $this->getColumns();

        if (null === $this->pk) {

            $values = array();
            $placeHolders = array();

            foreach ($columns as $column) {
                $values[] = $this->data->$column;
                $placeHolders[] = "?";
            }

            $sql = "INSERT INTO " . $this->getTable() . " (" . implode(", ", $columns)
                . ") VALUES (" . implode(", ", $placeHolders) . ")";

            DBPool::getInstance()->prepare($sql)->execute($values);

            $this->pk = DBPool::getInstance()->lastInsertId();
        } else {

            $values = array();
            $placeHolders = array();

            foreach ($columns as $column) {
                $values[] = $this->data->$column;
                $placeHolders[] = $column . " = ?";
            }

            $values[] = $this->pk;

            $sql = "UPDATE " . $this->getTable() . " SET " . implode(", ", $placeHolders)
                . " WHERE " . $this->getPrimaryKeyColumn() . " = ?";

            DBPool::getInstance()->prepare($sql)->execute($values);
        }
    }

    /**
     * Dohvat podatka.
     * @param type $pk primarni ključ
     */
    public function load($pk) {

        $sql = "SELECT * FROM " . $this->getTable() . " WHERE " .
            $this->getPrimaryKeyColumn() . " = ?";

        $statement = DBPool::getInstance()->prepare($sql);
        $statement->execute(array($pk));

        if (1 !== $statement->rowCount()) {
            throw new \Exception();
        }

        $this->data = $statement->fetch();
        $pkCol = $this->getPrimaryKeyColumn();
        $this->pk = $this->data->$pkCol;
    }

    /**
     * Brisanje modela.
     * @return void
     */
    public function delete() {
        if (null === $this->pk) {
            return;
        }
        DBPool::getInstance()->prepare("DELETE FROM " . $this->getTable() . " WHERE " .
            $this->getPrimaryKeyColumn() . " = ?"
        )->execute(array($this->pk));
        $this->pk = null;
    }

    /**
     * Ispitivanje jednakosti modela.
     * @param \oipa\model\Model $model model
     * @return boolean true ako su modeli jednaki, false inače
     */
    public function equals(Model $model) {

        if (get_class($this) !== get_class($model)) {
            return false;
        }

        return $this->pk === $model->getPrimaryKey();
    }

    /**
     * Serijaliziran objekt.
     * @return type
     */
    public function serialize() {
        return serialize($this->data);
    }

    /**
     * Deserijaliziran objekt.
     * @param type $string
     */
    public function unserialize($string) {
        $this->data = unserialize($string);
    }

    /**
     * Dohvaćanje primarnog ključa.
     * @return mixed
     */
    public function getPrimaryKey() {
        return $this->pk;
    }

    /**
     * Dohvat kolone retka.
     * @param type $name ime kolone
     * @return mixed
     */
    public function __get($name) {
        return $this->data->$name;
    }

    /**
     * Postavljanje vrijednosti kolone retka
     * @param type $name ime kolone
     * @param type $value vrijednost
     * @return mixed
     */
    public function __set($name, $value) {
        return $this->data->$name = $value;
    }

    /**
     * Dohvat primarnog ključa.
     */
    public abstract function getPrimaryKeyColumn(): string;

    /**
     * Dohvat tablice.
     */
    public abstract function getTable(): string;

    /**
     * Vraća sve kolone osim primarnog ključa.
     * @return array
     */
    public abstract function getColumns(): array;

    public function exists(string $property, string $value) {
        return $this->loadAllByParam("WHERE " . $property . " = ?", [$value]);
    }

    public function loadAll(string $where = "") {

        $sql = "SELECT * FROM " . $this->getTable() . " " .$where;

        $statement = DBPool::getInstance()->prepare($sql);
        $statement->execute();

        if (1 > $statement->rowCount()) {
            return [];
        }

        $resources = $statement->fetchAll();
        $collection = [];

        $className = get_class($this);
        foreach ($resources as $singleRow) {
            $model = new $className();
            $model->pk = $singleRow->{$this->getPrimaryKeyColumn()};
            $model->data = $singleRow;

            $collection[] = $model;
        }

        return $collection;
    }

    public function loadAllByParam(string $where = "", array $params = []) {
        $sql = "SELECT * FROM " . $this->getTable() . " " .$where;
        $statement = DBPool::getInstance()->prepare($sql);
        $statement->execute($params);

        if (1 > $statement->rowCount()) {
            return [];
        }

        $resources = $statement->fetchAll();
        return $resources;
    }

}