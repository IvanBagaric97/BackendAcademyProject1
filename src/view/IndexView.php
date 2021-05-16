<?php


namespace view;
use lib;

class IndexView extends AbstractView
{

    public function generateHTML()
    {
        $body = new lib\HTMLBodyElement();
        $table = new lib\HTMLTableElement();

        $table2 = new lib\HTMLTableElement();

        $form = new lib\HTMLFormElement();
        $form->add_attribute(new lib\HTMLAttribute("action", "/home"));
        $form->add_attribute(new lib\HTMLAttribute("method", "post"));

        $form2 = new lib\HTMLFormElement();
        $form2->add_attribute(new lib\HTMLAttribute("action", "/register"));
        $form2->add_attribute(new lib\HTMLAttribute("method", "post"));

        $username = new lib\HTMLInputElement();
        $username->add_attribute(new lib\HTMLAttribute("type", "text"));
        $username->add_attribute(new lib\HTMLAttribute("name", "email"));
        $username->add_attribute(new lib\HTMLAttribute("placeholder", "Username"));
        $username->add_attribute(new lib\HTMLAttribute("style",
            "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $password = new lib\HTMLInputElement();
        $password->add_attribute(new lib\HTMLAttribute("type", "password"));
        $password->add_attribute(new lib\HTMLAttribute("name", "password"));
        $password->add_attribute(new lib\HTMLAttribute("placeholder", "Password"));
        $password->add_attribute(new lib\HTMLAttribute("style",
            "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $login = new lib\HTMLInputElement();
        $login->add_attribute(new lib\HTMLAttribute("type", "submit"));
        $login->add_attribute(new lib\HTMLAttribute("name", "login"));
        $login->add_attribute(new lib\HTMLAttribute("value", "LOGIN"));
        $login->add_attribute(new lib\HTMLAttribute("style",
            "width:211px;background-color:#5ca4da;color:white;padding:14px 20px;margin:8px 0;border:none;border-radius:4px;cursor:pointer;"));

        $register = new lib\HTMLInputElement();
        $register->add_attribute(new lib\HTMLAttribute("type", "submit"));
        $register->add_attribute(new lib\HTMLAttribute("name", "register"));
        $register->add_attribute(new lib\HTMLAttribute("value", "REGISTER"));
        $register->add_attribute(new lib\HTMLAttribute("style",
            "width:211px;background-color:#4CAF50;color:white;padding:14px 20px;margin:8px 0;border:none;border-radius:4px;cursor:pointer;"));

        $center = new lib\HTMLAttribute("style", "text-align:center;");

        $design = new lib\HTMLImageElement("/resources/design.png");
        $design -> add_attribute(new lib\HTMLAttribute("style", "width:160px"));

        $c_design = new lib\HTMLCellElement();
        $c_design -> add_child($design);
        $c_design -> add_attribute(new lib\HTMLAttribute("height", "250px"));
        $c_design -> add_attribute($center);

        $c1 = new lib\HTMLCellElement();
        $c1 -> add_child($username);
        $c1 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c1 -> add_attribute($center);

        $c2 = new lib\HTMLCellElement();
        $c2 -> add_child($password);
        $c2 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c2 -> add_attribute($center);

        $c3 = new lib\HTMLCellElement();
        $c3 -> add_child($login);
        $c3 -> add_attribute($center);

        $c = new lib\HTMLCellElement();
        $c -> add_child($register);
        $c -> add_attribute($center);

        $table -> add_row(new lib\HTMLRowElement([$c_design]));
        $table -> add_row(new lib\HTMLRowElement([$c1]));
        $table -> add_row(new lib\HTMLRowElement([$c2]));
        $table -> add_row(new lib\HTMLRowElement([$c3]));

        $table2 -> add_row(new lib\HTMLRowElement([$c]));

        $table -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;"));
        $table2 -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;"));

        $form->add_child($table);
        $form2->add_child($table2);
        $body -> add_child($form);
        $body -> add_child($form2);

        echo $body;
    }
}