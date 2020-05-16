<?php

namespace Routing;

abstract class Route implements IRoute {
    private static array $map = [];

    /**
     * Metoda provjerava podudara li se ulazni niz znakova
     * s rutom.
     *
     * @param string $input ulazni niz znakova
     * @return bool true ako se podudara, inace false
     */
    public abstract function match(string $input): bool;

    /**
     * Metoda generira niz znakova koji predstavlja rutu.
     * Ako je predano asocijativno polje oblika kljuc => vrijednost,
     * ono predstavlja ime i vrijednost parametra.
     *
     * @param array $array polje ime_parametra => vrijednost_parametra
     * @return string
     */
    public abstract function generate(array $params = []): string;

    /**
     * Metoda za registraciju rute. U mapu $map se pod kljucem $name
     * pohranjuje ruta $route.
     *
     * @param string $name
     * @param Route $route
     */
    public static function register(string $name, Route $route): void {
        self::$map[$name] = $route;
    }

    public abstract function getParam(string $name): ?string;

    /**
     * Metoda vraca rutu ili cijelu mapu ruta.
     * Ako je predano ime, vraca rutu ili null.
     * Ako je metoda pozvana bez parametara, vraca
     * cijelu mapu ruta.
     *
     * @param string|null $name ime rute
     * @return Route|Route[]|null ruta, polje ruta ili null
     */
    public static function get(string $name = null) {
        if(empty($name)) {
            return self::$map;
        }
        return isset(self::$map[$name]) ? self::$map[$name] : null;
    }

}
