<?php

declare(strict_types=1);

/**
 * Ispisuje siguran string od HTML koda.
 *
 * @param string $v
 * @return string
 */
function __($v)
{
    return htmlentities($v, ENT_QUOTES, "utf-8");
}

/**
 * Iz URL-a dohvaca parametar imena $v.
 * Ukoliko parametra nema, null vracen.
 *
 * @param string $v Kljuc
 * @param type $d
 * @return type
 */
function get($v, $d = null)
{
    if (isset($_GET[$v]) && !empty($_GET[$v])) {
        return $_GET[$v];
    }
    return null;
}

/**
 * Iz tijela HTTP zahtjeva dohvaca parametar imena $v.
 * Ukoliko parametra nema, null vracen.
 *
 * @param string $v Kljuc
 * @param type $d
 * @return type
 */
function post($v, $d = null)
{
    if (isset($_POST[$v]) && !empty($_POST[$v])) {
        return $_POST[$v];
    }
    return null;
}

/**
 * Provjera je li zahtjev POST.
 * Ako je zahtjev POST, provjerava se postoji
 * li parametar naziva $key.
 * Ako parametar ne postoji, null vracen.
 *
 * @param type $key Kljuc
 * @return type
 */
function isPost($key = null) {
    if (null === $key) {
        return count($_POST) > 0;
    }
    return null !== post($key);
}

/**
 * Usmjeravanje na URL.
 * @param string $url
 */
function redirect(string $url): void
{
    header("Location: " . $url);
    die(); // prekida izvodenje skripte pozivateljice
}

