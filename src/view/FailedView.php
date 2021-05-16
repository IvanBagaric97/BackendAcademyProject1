<?php


namespace view;
use lib;

class FailedView extends AbstractView
{

    public function __construct(private array $e)
    {
    }

    public function generateHTML()
    {
        $body = new lib\HTMLBodyElement();
        $table = new lib\HTMLTableElement();

        $form = new lib\HTMLFormElement();
        $form->add_attribute(new lib\HTMLAttribute("action", $_SERVER['HTTP_REFERER'])); #### ne moze biti register
        $form->add_attribute(new lib\HTMLAttribute("method", "post"));

        $home = new lib\HTMLInputElement();
        $home->add_attribute(new lib\HTMLAttribute("type", "submit"));
        $home->add_attribute(new lib\HTMLAttribute("name", "home"));
        $home->add_attribute(new lib\HTMLAttribute("value", "< GO BACK"));
        $home->add_attribute(new lib\HTMLAttribute("style",
            "width:211px;background-color:#4CAF50;color:white;padding:14px 20px;margin:8px 0;border:none;border-radius:4px;cursor:pointer;"));

        $form->add_child($home);
        $center = new lib\HTMLAttribute("style", "text-align:center;");

        foreach($this -> e as $err){
            $text = new lib\HTMLH3Element($err);
            $text->add_attribute(new lib\HTMLAttribute("style", "color:black;font-size: 25px;"));

            $c1 = new lib\HTMLCellElement();
            $c1 -> add_child($text);
            $c1 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
            $c1 -> add_attribute($center);

            $table -> add_row(new lib\HTMLRowElement([$c1]));
        }

        $c1 = new lib\HTMLCellElement();
        $c1 -> add_child($form);
        $c1 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c1 -> add_attribute($center);
        $table -> add_row(new lib\HTMLRowElement([$c1]));

        $table -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;"));

        $body -> add_child($table);

        echo $body;
    }
}