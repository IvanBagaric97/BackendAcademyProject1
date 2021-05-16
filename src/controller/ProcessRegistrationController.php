<?php


namespace controller;
use db, view;


class ProcessRegistrationController extends AbstractController
{
    public function doAction() : void{

        $error = false;
        $e = array();
        foreach($_POST as $key => $value) {

            if (!isset($value) || strlen(trim($value)) == 0 ) {
                array_push($e, "Registration incomplete. Missing $key. Please try again!</br>");

                $error = true;
            }
        }

        if($error === true){
            $h = new view\FailedView($e);
            $h -> generateHTML();
        }

        if (count($_POST) == 0) {
            $error = true;
        }

        if ($error == false) {
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $date = $_POST["date"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $repeat_password = $_POST["repeat_password"];

            if($password !== $repeat_password){
                array_push($e, "Password and repeated password are not the same.</br>");
                $error = true;
            }

            if(strlen($password) <= 4){
                array_push($e, "Password needs to be at least 5 characters long.</br>");
                $error = true;
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($e, "Please enter valid email.</br>");
                $error = true;
            }

            $a = new db\DBDriver();
            if ($a -> exists($email)) {
                array_push($e, "This username is already taken.</br>");
                $error = true;
            }

            if($error === true){
                $h = new view\FailedView($e);
                $h -> generateHTML();
            }
        }

        if ($error === false) {
            $a = new db\DBDriver();
            $a -> set_new_user($name, $surname, $date, $email, sha1($password));
            $_SESSION["id"] = $a -> get_user_id($email);

            $h = new view\SuccessRegisterView();
            $h -> generateHTML();
        }
    }
}