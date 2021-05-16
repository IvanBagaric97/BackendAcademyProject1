<?php

namespace lib;

use JetBrains\PhpStorm\NoReturn;
use JetBrains\PhpStorm\Pure;
use view;

/**
 * @param string $needle
 * @param array $haystack
 * @param mixed $default
 * @return mixed
 */
function element(string $needle, array $haystack, $default = null): mixed
{
    if ($haystack == null) {
        return $default;
    }
    if ($needle == null) {
        return $default;
    }
    return $haystack[$needle] ?? $default;
}

/**
 * Ispisuje siguran string od HTML koda.
 * @param string $v
 * @return string
 */
#[Pure] function __(string $v): string{
    return htmlentities($v, ENT_QUOTES, "utf-8");
}

/**
 * Iz URL-a dohvaca parametar $v.
 * Ukoliko parametra nema, null vracen.
 * @param string $v
 * @param null $d
 */
function get(string $v, $d = null){
    return $_GET[$v] ?? $d;
}

/**
 * Iz tijela HTTP zahtjeva dohvaca parametar imena $v.
 * Ukoliko parametra nema vracen null.
 * @param string $v
 * @param null $d
 */
function post(string $v, $d = null){
    return $_POST[$v] ?? $d;
}

/**
 * Provjerava je li zahtjev POST.
 * Ako je zahtjev POST, provjerava se postoji li
 * parametar nazvav $key
 * @param null $key
 * @return bool
 */
#[Pure] function isPost($key = null): bool{
    if(null === $key){
        return count($_POST) > 0;
    }

    return null !== post($key);
}

/**
 * Provjerava je li varijabla $param prazna ili null
 * @param $param
 * @return bool
 */
function paramExists($param): bool{
    if(null !== $param && ! empty ( $param )) return true;
    return false;
}

/**
 * Usmjeravanje na URL .
 * @param $url
 */
#[NoReturn] function redirect($url) : void {
    header("Location:" . $url);
    die(); // prekida izvodenje skripte pozivateljice
}

/**
 * Provjera prijavljenosti korisnika .
 * @return true ako je korisnik prijavljen , false inace
 */
function isLoggedIn (): bool{
    if(isset($_COOKIE["PHPSESSID"])) return true;
    else return false;
}

/**
 * Vraca ID prijavljenog korisnika
 * @return ?int ako je korisnik prijavljen , null inace
 */
#[Pure] function userID (): ?int {
    return $_SESSION["user_id"] ?? null;
}

#[Pure] function compareName($a, $b): int
{
    return strnatcmp($a[1], $b[1]);
}

#[Pure] function compareYear($a, $b): int
{
    return strnatcmp($a[3], $b[3]);
}

#[Pure] function compareDuration($a, $b): int
{
    return strnatcmp($a[4], $b[4]);
}

##################################################
### HTML LIB #####################################
##################################################

/**
 * ispisuje sadržaj "<!doctype html>"
 */
function create_doctype(): void
{
    echo "<!doctype html>";
}

/**
 * ispisuje otvarajući tag <html>
 */
function begin_html(): void
{
    echo "<html>";
}

/**
 * ispisuje zatvarajući tag </html>
 */
function end_html(): void
{
    echo "</html>";
}

/**
 * ispisuje otvarajući tag <head>
 */
function begin_head(): void
{
    echo "<head>";
}

/**
 * ispisuje zatvarajuci tag </head>
 */
function end_head(): void
{
    echo "</head>";
}

/**
 * iz asocijativnog polja izvlači sve atribute i vraća ih kao string
 *
 * @param array $params asocijativno polje parova atribut => vrijednost
 * @return string oblika atribut = vrijednost, može se sastojati od vise atributa
 */
#[Pure] function get_attributes(array $params = []): string
{
    $allAttrs = "";
    foreach ($params as $k => $v) {
        if ($k === "contents") continue;
        $allAttrs .= " " . strval($k) . "=" . "'" . strval($v) . "'";
    }
    return $allAttrs;
}

/**
 * ispisuje otvarajuci tag <body> i pridruzuje mu parove
 * atribut, vrijednost na temelju predanih parametara
 *
 * @param array $params asocijativno polje parova atribut => vrijednost
 */
function begin_body(array $params = []): void
{
    $allAttrs = "<body" . get_attributes($params) . ">";

    echo $allAttrs;
}

/**
 * ispisuje zatvarajuci tag </body>
 */
function end_body(): void
{
    echo "</body>";
}

/**
 * ispisuje otvarajuci tag <table> i pridruzuje mu parove
 * atribut, vrijednost na temelju predanih parametara
 *
 * @param array $params asocijativno polje parova atribut => vrijednost
 */
function create_table(array $params = []): void
{
    $allAttrs = "<table" . get_attributes($params) . ">";

    echo $allAttrs;
}

/**
 * ispisuje zatvarajuci tag </table>
 */
function end_table(): void
{
    echo "</table>";
}

/**
 * Generira html potreban za stvaranje jednog retka tablice.
 * U polju parametara koje prima su definirane i celije tablice i to
 * parametrom 'contents' (ne sadrzi vrijednosti celija nego HTML kod
 * koji definira svaku celiju)
 *
 * @param array $params asocijativno polje parova koje odreduje jedan
 * redak tablice
 * @return string niz znakova koji predstavlja HTML kod retka tablice
 */
#[Pure] function create_table_row(array $params = []): string
{
    $allAttrs = "<tr" . get_attributes($params) . ">";

    $content = $params["contents"] ?? [];

    if (gettype($content) === "string") {
        $allAttrs .= $content;
    } else {
        foreach ($content as $c) {
            $allAttrs .= $c;
        }
    }
    $allAttrs .= "</tr>";

    return $allAttrs;
}

/**
 * Generira HTML kod celije. Sadrzaj celije odreden je
 * parametrom 'contents' koji se nalazi u asocijativnom polju
 *
 * @param array $params asocijativno polje parova koje odreduje jednu
 * celiju tablice
 * @return string niz znakova koji predstavlja HTML kod celije
 */
#[Pure] function create_table_cell(array $params = []): string
{
    $allAttrs = "<td" . get_attributes($params) . ">";

    $content = $params["contents"] ?? [];
    $cell = "";

    if (gettype($content) === "string") {
        $cell .= $allAttrs . $content . "</td>";
    } else {
        foreach ($content as $c) {
            $cell .= $allAttrs . $c . "</td>";
        }
    }

    return $cell;
}

/**
 * Generira HTML kod proizvoljnog elementa
 *
 * @param string $name naziv elementa
 * @param bool $closed true ako ima zatvarajuci tag
 * @param array $params polje parametara koje odreduje element
 * @return string niz znakova jednak HTML kodu elementa
 */
#[Pure] function create_element(string $name, bool $closed = true, array $params = []): string
{
    $element = "<" . $name . get_attributes($params);

    if ($closed) $element .= ">";

    $content = $params["contents"] ?? [];

    if (gettype($content) === "string") {
        $element .= $content;
    } else {
        foreach ($content as $c) $element .= $c;
    }
    $element = $closed ? $element . "</" . $name . ">" : $element . ">";   #pazi jel ide /

    return $element;
}

function start_form($action, $method, $enctype = null): void
{
    $element = "<form " . "method=" . $method . " action=" . $action;
    $end = $enctype ? " enctype=" . $enctype . ">" : ">";
    $element .= $end;

    echo $element;      #jel vracam ili printam
}

function end_form(): void
{
    echo "</form>";
}

#[Pure] function create_input($params): string
{
    return "<input" . get_attributes($params) . ">";
}

#[Pure] function create_select($params): string
{
    $element = "<select" . get_attributes($params) . ">";

    $content = $params["contents"] ?? [];

    if (gettype($content) === "string") {
        $element .= $content;
    } else {
        foreach ($content as $c) $element .= $c;
    }

    $element .= "</select>";

    return $element;
}

#[Pure] function create_button($params): string
{
    $element = "<button" . get_attributes($params) . ">";

    $content = $params["contents"] ?? [];

    if (gettype($content) === "string") {
        $element .= $content;
    } else {
        foreach ($content as $c) $element .= $c;
    }

    $element .= "</button>";

    return $element;
}

function get_questions($file): array
{
    $handle = fopen($file, "r");
    $pitanja = array();
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $pitanje = array();
            if ($line[0] === "#" | ctype_space($line)) continue;

            $l = explode(":", $line);
            $pitanje[] = trim(substr($l[0], -2)[0]);
            $pitanje[] = trim(explode("{", $l[0])[0]);

            $x = explode("=", $l[1]);
            $polje_ponudenih = array();
            foreach (explode(",", $x[0]) as $a) {
                $polje_ponudenih[] = trim($a);
            }
            $pitanje[] = $polje_ponudenih;
            $pitanje[] = trim($x[1]);

            $pitanja[] = $pitanje;
        }
        fclose($handle);
    } else {
        echo "Error, file could not be opened";
    }
    return $pitanja;
}

function to_qref(string $save) : string{
    $name = "resources/file_" . time() . ".qref";
    $myfile = fopen($name, "w");
    fwrite($myfile, $save);
    return $name;
}

function check_access(){
    if (!isset($_SESSION["id"])) {
        $h = new view\AccessView();
        $h -> generateHTML();
        die();
    }
}

// function to calculate the standard deviation
// of array elements
function stand_deviation($arr) : float{
    $num_of_elements = count($arr);

    $variance = 0.0;

    // calculating mean using array_sum() method
    $average = array_sum($arr)/$num_of_elements;

    foreach($arr as $i)
    {
        // sum of squares of differences between
        // all numbers and means.
        $variance += pow(($i - $average), 2);
    }

    return (float)sqrt($variance/$num_of_elements);
}

function calculate_median($arr) : float{
    $count = count($arr); //total numbers in array
    $middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
    if($count % 2) { // odd number, middle is the median
        $median = $arr[$middleval];
    } else { // even number, calculate avg of 2 medians
        $low = $arr[$middleval];
        $high = $arr[$middleval+1];
        $median = (($low+$high)/2);
    }
    return $median;
}

function calculate_average($arr) : float{
    $total = 0;
    $count = count($arr); //total numbers in array
    foreach ($arr as $value) {
        $total += $value; // total value of array numbers
    }
    return ($total/$count); // get average value
}