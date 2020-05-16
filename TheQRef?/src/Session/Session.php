<?php

namespace Session;

/**
 * Class Session
 *
 * Razredom izbjegavamo razvlacenje superglobalnih varijabli kroz kod
 *
 * @package Session
 */
class Session {

    public static function set(string $id, string $name, string $surname): void {
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $name;
        $_SESSION["surname"] = $surname;
        $_SESSION["login"] = true;
    }

    public static function get(string $str) {
        return (isset($_SESSION[$str]) ? $_SESSION[$str] : null);
    }

    public static function destroy(): void {
        session_destroy();
        unset($_SESSION);
    }

    public static function start(): void {
        session_start();
    }
}
