<?php


namespace controller;
use view, db, lib;


class SaveEditController extends AbstractController
{
    public function doAction() : void
    {
        lib\check_access();

        $error = false;
        $e = array();
        foreach($_POST as $key => $value) {

            if (!isset($value) || strlen(trim($value)) == 0 ) {
                array_push($e, "Profile edit incomplete. Missing $key. Please try again!</br>");

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
            $new_date = $_POST["date"];
            $new_email = $_POST["email"];
            $old_password = $_POST["old_password"];
            $new_password = $_POST["new_password"];
            $repeat_password = $_POST["repeat_password"];

            $a = new db\DBDriver();

            if(sha1($old_password) !== $a -> get_user_by_id($_SESSION["id"])["password"]){
                array_push($e, "Wrong old password</br>");
                $error = true;
            }

            if($new_password !== $repeat_password){
                array_push($e, "Password and repeated password are not the same.</br>");
                $error = true;
            }

            if(strlen($new_password) <= 4){
                array_push($e, "Password needs to be at least 5 characters long.</br>");
                $error = true;
            }

            if(!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
                array_push($e, "Please enter valid email.</br>");
                $error = true;
            }

            if ($a -> exists($new_email)) {
                array_push($e, "This username is already taken.</br>");
                $error = true;
            }

            if($error === true){
                $h = new view\FailedView($e);       #uredi da FailVIew bude univerzalan
                $h -> generateHTML();
            }
        }

        if ($error === false) {
            $a = new db\DBDriver();
            $a -> edit_user($_SESSION["id"], $new_date, $new_email, sha1($new_password));

            header("Location: /account");
            die();
        }
    }
}