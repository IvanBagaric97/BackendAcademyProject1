<?php


namespace view;
use lib;


class AccountEditView extends AbstractView
{

    public function generateHTML()
    {
        $body = new lib\HTMLBodyElement();
        $table = new lib\HTMLTableElement();

        $center = new lib\HTMLAttribute("style", "text-align:center;");

        $form = new lib\HTMLFormElement();
        $form->add_attribute(new lib\HTMLAttribute("action", "/account/save_edit"));
        $form->add_attribute(new lib\HTMLAttribute("method", "post"));

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

        $old_password = new lib\HTMLInputElement();
        $old_password->add_attribute(new lib\HTMLAttribute("type", "password"));
        $old_password->add_attribute(new lib\HTMLAttribute("name", "old_password"));
        $old_password->add_attribute(new lib\HTMLAttribute("placeholder", "Old Password"));
        $old_password->add_attribute(new lib\HTMLAttribute("style",
            "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $new_password = new lib\HTMLInputElement();
        $new_password->add_attribute(new lib\HTMLAttribute("type", "password"));
        $new_password->add_attribute(new lib\HTMLAttribute("name", "new_password"));
        $new_password->add_attribute(new lib\HTMLAttribute("placeholder", "New Password"));
        $new_password->add_attribute(new lib\HTMLAttribute("style",
            "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $repeat_password = new lib\HTMLInputElement();
        $repeat_password->add_attribute(new lib\HTMLAttribute("type", "password"));
        $repeat_password->add_attribute(new lib\HTMLAttribute("name", "repeat_password"));
        $repeat_password->add_attribute(new lib\HTMLAttribute("placeholder", "Repeat Password"));
        $repeat_password->add_attribute(new lib\HTMLAttribute("style",
            "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $save = new lib\HTMLInputElement();
        $save->add_attribute(new lib\HTMLAttribute("type", "submit"));
        $save->add_attribute(new lib\HTMLAttribute("name", "save"));
        $save->add_attribute(new lib\HTMLAttribute("value", "SAVE CHANGES"));
        $save->add_attribute(new lib\HTMLAttribute("style",
            "width:211px;background-color:#4CAF50;color:white;padding:14px 20px;margin:8px 0;border:none;border-radius:4px;cursor:pointer;"));

        $c2 = new lib\HTMLCellElement();
        $c2 -> add_child($date);
        $c2 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c2 -> add_attribute($center);

        $c3 = new lib\HTMLCellElement();
        $c3 -> add_child($email);
        $c3 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c3 -> add_attribute($center);

        $c4 = new lib\HTMLCellElement();
        $c4 -> add_child($old_password);
        $c4 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c4 -> add_attribute($center);

        $c5 = new lib\HTMLCellElement();
        $c5 -> add_child($new_password);
        $c5 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c5 -> add_attribute($center);

        $c6 = new lib\HTMLCellElement();
        $c6 -> add_child($repeat_password);
        $c6 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c6 -> add_attribute($center);

        $c8 = new lib\HTMLCellElement();
        $c8 -> add_child($save);
        $c8 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c8 -> add_attribute($center);

        $c_empty = new lib\HTMLCellElement();
        $c_empty -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c_empty -> add_attribute($center);

        $c_text = new lib\HTMLCellElement();
        $c_text -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c_text -> add_attribute($center);

        $c_text ->add_child(new lib\HTMLH3Element("EDIT PROFILE:"));

        $table -> add_row(new lib\HTMLRowElement([$c_empty]));
        $table -> add_row(new lib\HTMLRowElement([$c_text]));
        $table -> add_row(new lib\HTMLRowElement([$c2]));
        $table -> add_row(new lib\HTMLRowElement([$c3]));
        $table -> add_row(new lib\HTMLRowElement([$c4]));
        $table -> add_row(new lib\HTMLRowElement([$c5]));
        $table -> add_row(new lib\HTMLRowElement([$c6]));
        $table -> add_row(new lib\HTMLRowElement([$c8]));

        $table -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;"));

        $form->add_child($table);

        $body -> add_child($form);

        echo $body;
    }
}