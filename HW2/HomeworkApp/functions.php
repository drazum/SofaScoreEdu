<?php
declare(strict_types=1);
/**
* Ispisuje siguran string od HTML koda .
* @param string $v
* @return string
*/
function __ ( $v ) {
    return htmlentities ( $v , ENT_QUOTES , "utf-8" );
}

/**
* Iz URL - a dohvaca parametar imena $v .
* Ukoliko parametra nema , null vracen .
* @param string $v
* @param type $d
* @return type
*/
function get ( $v , $d = null ) {
    if(isset($_GET[$v]) || !empty($_GET[$v])){
        return $_GET[$v];
    }
    return null;
}

/**
* Iz tijela HTTP zahtjeva dohvaca parametar imena $v .
* Ukoliko parametra nema , null vracen .
* @param string $v
* @param type $d
* @return type
*/
function post ( $v , $d = null ) {
    if(isset($_POST[$v]) || !empty($_POST[$v])){
        return $_POST[$v];
    }
    return null;
}

/**
* Provjera je li zahtjev POST .
* Ako je zahtjev POST , provjerava se postoji
* li parametar naziva $key .
* Ako parametar ne postoji , null vracen .
* @param type $key
* @return type
*/
function isPost ( $key = null ) {
    if ( null === $key ) {

        return count ( $_POST ) > 0;

    }
    return null !== post ( $key );

}

/**
* Usmjeravanje na URL .
* @param type $url
*/
function redirect (string $url ) : void {

    header( "Location: " . $url );
    die (); // prekida izvodenje skripte pozivateljice

}

/**
* Provjera prijavljenosti korisnika .
* @return type true ako je korisnik prijavljen , false inace
*/
function isLoggedIn() : bool {
    $lines = file("users.txt");
    $inputMail = trim($_POST["mail"]);
    $inputPassword = trim($_POST["password"]);

    foreach ($lines as $user) {
        [$userID, $firstName,$lastName, $mail, $password, ] = explode(";", $user);

        if ($inputMail === trim($mail)) {
            // Korisnik postoji
            $_SESSION["user"] = $mail;
            return true;
        }
    }
    return false;
}

/**
 * vrati podatke prijavljenog studenta s obzirom na unikatan id
 * @return polje s vrijednostima studenta
 */
function getStudentData(string $userID) : ?array {
    $lines = file("homeworks.txt");
    $emptyArr = array_fill(0, 4, null);
    foreach ($lines as $line) {
        [$hwID, $studentID, $hwName, $score] = explode(";", $line);
        if($userID === $studentID) {
            return [$hwID, $studentID, $hwName, $score];
        }
    }
    return $emptyArr;
}

/**
 * vrati podatke prijavljenog korisnika s obzirom na e-mail
 * @return polje s vrijednostima korisnika
 */
function getUserData (string $findMail) : ?array {
    $lines = file("users.txt");
    $emptyArr = array_fill(0, 4, null);
    foreach ($lines as $line) {
        [$userID, $firstName,$lastName, $mail, $password ] = explode(";", $line);
        if ($findMail === $mail) {
            return [$userID, $firstName, $lastName, $mail, $password];
        }
    }
    return $emptyArr;
}

/**
* Dodijeli ID prijavljenom korisniku
* @return niz znakova unique ID korisnika
*/
function setUserID () : string {
    return uniqid();
}

/**
 * Upisuje korisnika u bazu
 *
 */
function registerUser() : void{
    $file = fopen("users.txt", 'a+');

    $userStruct = (string)setUserID();
    foreach ($_POST as $k => $v) {
        if ($k !== "submit" && $k !== "formType") {
            $userStruct .= ";".($k==="password" ? sha1($v) : $v);
        }
    }
    fwrite($file, $userStruct."\n");
    fclose($file);
}
?>
