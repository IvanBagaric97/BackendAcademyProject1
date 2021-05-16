<?php


namespace view;
use lib;


class SolveView extends AbstractView
{
    public function __construct(private int $id, private array $pitanja)
    {
    }

    public function generateHTML()
    {
        lib\start_form("/evaluate/" . strval($this -> id), "post");
        $br_pitanja = 1;
        foreach($this->pitanja as $p){

            if($p[0] === "1") $type = "radio";
            elseif ($p[0] === "2") $type = "checkbox";
            else $type = "text";

            $choice = array();
            $multiple_choice = $p[2];

            echo strval($br_pitanja) . ". " . $p[1] . "<br>";

            foreach($multiple_choice as $x){
                $choice[] = lib\create_input(["type" => $type, "name" => "pitanje" . strval($br_pitanja) . "[]", "value" => $x]);
                $choice[] = $x;
                echo lib\create_element("label", true, ["contents" => $choice]) . "<br>";
                $choice = array();
            }

            $br_pitanja += 1;
            echo "<br>";
        }
        echo lib\create_input(["type" => "submit", "value" => "Send"]);

        lib\end_form();
    }
}