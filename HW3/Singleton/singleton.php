<?php
declare(strict_types=1);


// Razred nije moguce naslijediti
final class SingletonExample {
    private static object $instance;
    private string $id;

    // Onemoguceno instanciranje izvan dosega razreda
    private function __construct() {
        $this->id = "Jedina instanca stvorena";
    }

    // Onemoguceno kloniranje izvan dosega razreda jer se kloniranjem stvara novi objekt
    private function __clone() {}

    public static function getInstance() : object {
        if (!isset(self::$instance)) {
            self::$instance = new SingletonExample();
        }
        return self::$instance;
    }

    public function getID () {
        return $this->instanceID;
    }
}



$inst1 = SingletonExample::getInstance();
$inst2 = SingletonExample::getInstance();

// Jednaki u slucaju kada obje instance pokazuju na isti objekt u memoriji
echo (int)($inst1===$inst2);