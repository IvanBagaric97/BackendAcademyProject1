<?php


namespace controller;
use view, db;

class HomeController extends AbstractController
{
    public function doAction() : void
    {
        if (isset($_SESSION["id"])) {

            $a = new db\DBDriver();
            $user = $a -> get_user_by_id($_SESSION["id"]);
            $e = $user["name"] . " " . $user["surname"];

            $h = new view\HeaderView($e);

        }else{

            $error = false;
            $e = [];
            foreach($_POST as $key => $value) {

                if (!isset($value) || strlen(trim($value)) == 0 ) {
                    array_push($e, "Prijava nepotpuna. Nedostaje vrijednost $key. Molim pokusajte ponovno!</br>");

                    $error = true;
                }
            }

            if (count($_POST) == 0) {
                $error = true;
                $h = new view\AccessView();
                $h -> generateHTML();
                die();
            }

            if ($error == false) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $a = new db\DBDriver();
                $user = $a->get_user_by_email($email, sha1($password));

                if ($user && $user["email"] === $email && $user["password"] === sha1($password)) {
                    $_SESSION["id"] = $a->get_user_id($email);
                    header("Location: /home");
                    die();
                } else {
                    array_push($e, "Neispravno korisnicko ime ili lozinka.</br>");
                    $error = true;
                }
            }

            $h = new view\FailedView($e);
        }
        $h -> generateHTML();
    }
}