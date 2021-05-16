<?php


namespace controller;
use lib, view, db;

class ProcessCreateController extends AbstractController
{
    public function doAction() : void
    {
        lib\check_access();

        $error = false;
        $e = array();

        if (count($_POST) == 0) {
            $error = true;
        }

        if ($error == false) {
            $name = lib\post("quiz_name");
            $description = lib\post("quiz_description");
            $quiz_text = lib\post("quiz_text");
            $isPublic = (bool)lib\post("quiz_public");
            $comments = (bool)lib\post("quiz_comments");

            if(array_key_exists("quiz_file", $_FILES)){
                $file = $_FILES["quiz_file"];
            }else{
                $file = null;
                $newName = lib\to_qref($quiz_text);
            }

            if(trim($name) == ""){
                array_push($e, "Missing quiz name.</br>");
                $error = true;
            }

            if(trim($description) == ""){
                array_push($e, "Missing quiz description.</br>");
                $error = true;
            }

            if(is_null($file) and trim($quiz_text) == null){
                array_push($e, "You need to input quiz file or quiz text.</br>");
                $error = true;
            }

            if(!is_null($file)){
                $upload_dir = "resources/";
                $uploadFile = $file["name"];

                $array = explode(".", $uploadFile);
                $fileExtension = end($array);

                $newName = $upload_dir . "file_" . time() . "." . $fileExtension;

                move_uploaded_file($file["tmp_name"], $newName);
            }

            $a = new db\DBDriver();
            if ($a -> quiz_exists($name)) {
                array_push($e, "This quiz name is already taken.</br>");
                $error = true;
            }
        }

        if($error === true){
            $h = new view\FailedView($e);       ############
            $h -> generateHTML();
        }

        if ($error === false) {
            $a = new db\DBDriver();
            $a -> set_new_quiz($name, $description, $newName, $isPublic, $comments);

            header("Location: /home");
            die();
        }
    }
}