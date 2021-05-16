<?php


namespace view;
use lib;


class RegisterView extends AbstractView
{

    public function generateHTML()
    {
        $body = new lib\HTMLBodyElement();
        $table = new lib\HTMLTableElement();

        $form = new lib\HTMLFormElement();
        $form->add_attribute(new lib\HTMLAttribute("action", "/registered"));
        $form->add_attribute(new lib\HTMLAttribute("method", "post"));

        #$username = new lib\HTMLInputElement();
        #$username->add_attribute(new lib\HTMLAttribute("type", "text"));
        #$username->add_attribute(new lib\HTMLAttribute("name", "username"));
        #$username->add_attribute(new lib\HTMLAttribute("placeholder", "Username"));
        #$username->add_attribute(new lib\HTMLAttribute("style",
        #    "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $name = new lib\HTMLInputElement();
        $name->add_attribute(new lib\HTMLAttribute("type", "text"));
        $name->add_attribute(new lib\HTMLAttribute("name", "name"));
        $name->add_attribute(new lib\HTMLAttribute("placeholder", "Name"));
        $name->add_attribute(new lib\HTMLAttribute("style",
            "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $surname = new lib\HTMLInputElement();
        $surname->add_attribute(new lib\HTMLAttribute("type", "text"));
        $surname->add_attribute(new lib\HTMLAttribute("name", "surname"));
        $surname->add_attribute(new lib\HTMLAttribute("placeholder", "Surname"));
        $surname->add_attribute(new lib\HTMLAttribute("style",
            "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $date = new lib\HTMLInputElement();
        $date->add_attribute(new lib\HTMLAttribute("type", "date"));
        $date->add_attribute(new lib\HTMLAttribute("name", "date"));
        $date->add_attribute(new lib\HTMLAttribute("placeholder", "Date of birth"));
        $date->add_attribute(new lib\HTMLAttribute("style",
            "width:211px;box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $email = new lib\HTMLInputElement();
        $email->add_attribute(new lib\HTMLAttribute("type", "email"));
        $email->add_attribute(new lib\HTMLAttribute("name", "email"));
        $email->add_attribute(new lib\HTMLAttribute("placeholder", "Email"));
        $email->add_attribute(new lib\HTMLAttribute("style",
            "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $password = new lib\HTMLInputElement();
        $password->add_attribute(new lib\HTMLAttribute("type", "password"));
        $password->add_attribute(new lib\HTMLAttribute("name", "password"));
        $password->add_attribute(new lib\HTMLAttribute("placeholder", "Password"));
        $password->add_attribute(new lib\HTMLAttribute("style",
            "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $repeat_password = new lib\HTMLInputElement();
        $repeat_password->add_attribute(new lib\HTMLAttribute("type", "password"));
        $repeat_password->add_attribute(new lib\HTMLAttribute("name", "repeat_password"));
        $repeat_password->add_attribute(new lib\HTMLAttribute("placeholder", "Repeat Password"));
        $repeat_password->add_attribute(new lib\HTMLAttribute("style",
            "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $register = new lib\HTMLInputElement();
        $register->add_attribute(new lib\HTMLAttribute("type", "submit"));
        $register->add_attribute(new lib\HTMLAttribute("name", "register"));
        $register->add_attribute(new lib\HTMLAttribute("value", "REGISTER"));
        $register->add_attribute(new lib\HTMLAttribute("style",
            "width:211px;background-color:#4CAF50;color:white;padding:14px 20px;margin:8px 0;border:none;border-radius:4px;cursor:pointer;"));


        $center = new lib\HTMLAttribute("style", "text-align:center;");

        $design = new lib\HTMLImageElement("/resources/design.png");
        $design -> add_attribute(new lib\HTMLAttribute("style", "width:100px"));
        $a1 = new lib\HTMLAElement("/", "");
        $a1 -> add_child($design);

        $c_design = new lib\HTMLCellElement();
        $c_design -> add_child($a1);
        $c_design -> add_attribute(new lib\HTMLAttribute("height", "150px"));
        $c_design -> add_attribute($center);

        #$c1 = new lib\HTMLCellElement();
        #$c1 -> add_child($username);
        #$c1 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        #$c1 -> add_attribute($center);

        $c2 = new lib\HTMLCellElement();
        $c2 -> add_child($name);
        $c2 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c2 -> add_attribute($center);

        $c3 = new lib\HTMLCellElement();
        $c3 -> add_child($surname);
        $c3 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c3 -> add_attribute($center);

        $c4 = new lib\HTMLCellElement();
        $c4 -> add_child($date);
        $c4 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c4 -> add_attribute($center);

        $c5 = new lib\HTMLCellElement();
        $c5 -> add_child($email);
        $c5 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c5 -> add_attribute($center);

        $c6 = new lib\HTMLCellElement();
        $c6 -> add_child($password);
        $c6 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c6 -> add_attribute($center);

        $c7 = new lib\HTMLCellElement();
        $c7 -> add_child($repeat_password);
        $c7 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c7 -> add_attribute($center);

        $c8 = new lib\HTMLCellElement();
        $c8 -> add_child($register);
        $c8 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c8 -> add_attribute($center);

        $table -> add_row(new lib\HTMLRowElement([$c_design]));
        #$table -> add_row(new lib\HTMLRowElement([$c1]));
        $table -> add_row(new lib\HTMLRowElement([$c2]));
        $table -> add_row(new lib\HTMLRowElement([$c3]));
        $table -> add_row(new lib\HTMLRowElement([$c4]));
        $table -> add_row(new lib\HTMLRowElement([$c5]));
        $table -> add_row(new lib\HTMLRowElement([$c6]));
        $table -> add_row(new lib\HTMLRowElement([$c7]));
        $table -> add_row(new lib\HTMLRowElement([$c8]));

        $table -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;"));

        $form->add_child($table);

        $body -> add_child($form);

        echo $body;
    }
}