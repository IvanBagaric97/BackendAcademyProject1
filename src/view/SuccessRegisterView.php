<?php

namespace view;
use lib;


class SuccessRegisterView extends AbstractView
{

    public function generateHTML()
    {
        $body = new lib\HTMLBodyElement();
        $table = new lib\HTMLTableElement();

        $form = new lib\HTMLFormElement();
        $form->add_attribute(new lib\HTMLAttribute("action", "/home"));
        $form->add_attribute(new lib\HTMLAttribute("method", "post"));

        $home = new lib\HTMLInputElement();
        $home->add_attribute(new lib\HTMLAttribute("type", "submit"));
        $home->add_attribute(new lib\HTMLAttribute("name", "home"));
        $home->add_attribute(new lib\HTMLAttribute("value", "GO TO HOMEPAGE"));
        $home->add_attribute(new lib\HTMLAttribute("style",
            "width:211px;background-color:#5ca4da;color:white;padding:14px 20px;margin:8px 0;border:none;border-radius:4px;cursor:pointer;"));

        $form->add_child($home);

        $text = new lib\HTMLH3Element("Registration Successful!");
        $text->add_attribute(new lib\HTMLAttribute("style", "color:#5ca4da;font-size: 100px;font-family:Lucida Handwriting;"));

        $center = new lib\HTMLAttribute("style", "text-align:center;");

        $c1 = new lib\HTMLCellElement();
        $c1 -> add_child($text);
        $c1 -> add_attribute(new lib\HTMLAttribute("height", "400px"));
        $c1 -> add_attribute($center);

        $c2 = new lib\HTMLCellElement();
        $c2 -> add_child($form);
        $c2 -> add_attribute(new lib\HTMLAttribute("height", "150px"));
        $c2 -> add_attribute($center);

        $table -> add_row(new lib\HTMLRowElement([$c1]));
        $table -> add_row(new lib\HTMLRowElement([$c2]));

        $table -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;"));

        $body -> add_child($table);

        echo $body;
    }
}