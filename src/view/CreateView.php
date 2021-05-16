<?php


namespace view;
use lib;

class CreateView extends AbstractView
{

    public function generateHTML()
    {
        $body = new lib\HTMLBodyElement();
        $table = new lib\HTMLTableElement();

        $center = new lib\HTMLAttribute("style", "text-align:center;");

        $form = new lib\HTMLFormElement();
        $form->add_attribute(new lib\HTMLAttribute("action", "/created"));
        $form->add_attribute(new lib\HTMLAttribute("method", "post"));
        $form->add_attribute(new lib\HTMLAttribute("enctype", "multipart/form-data"));

        $quiz_name = new lib\HTMLInputElement();
        $quiz_name->add_attribute(new lib\HTMLAttribute("type", "text"));
        $quiz_name->add_attribute(new lib\HTMLAttribute("name", "quiz_name"));
        $quiz_name->add_attribute(new lib\HTMLAttribute("placeholder", "Quiz Name"));
        $quiz_name->add_attribute(new lib\HTMLAttribute("style",
            "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $quiz_description = new lib\HTMLInputElement();
        $quiz_description->add_attribute(new lib\HTMLAttribute("type", "text"));
        $quiz_description->add_attribute(new lib\HTMLAttribute("name", "quiz_description"));
        $quiz_description->add_attribute(new lib\HTMLAttribute("placeholder", "Quiz Description"));
        $quiz_description->add_attribute(new lib\HTMLAttribute("style",
            "box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $quiz_file = new lib\HTMLInputElement();
        $quiz_file->add_attribute(new lib\HTMLAttribute("type", "file"));
        $quiz_file->add_attribute(new lib\HTMLAttribute("name", "quiz_file"));
        $quiz_file->add_attribute(new lib\HTMLAttribute("placeholder", "Quiz File (.qref)"));
        $quiz_file->add_attribute(new lib\HTMLAttribute("style",
            "width:218px;box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $quiz_text = new lib\HTMLTextAreaElement();
        $quiz_text->add_attribute(new lib\HTMLAttribute("type", "textarea"));
        $quiz_text->add_attribute(new lib\HTMLAttribute("name", "quiz_text"));
        $quiz_text->add_attribute(new lib\HTMLAttribute("placeholder", "Quiz Text Area"));
        $quiz_text->add_attribute(new lib\HTMLAttribute("style",
            "width:211px;height:211px;box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

        $quiz_public = new lib\HTMLInputElement();
        $quiz_public->add_attribute(new lib\HTMLAttribute("type", "checkbox"));
        $quiz_public->add_attribute(new lib\HTMLAttribute("name", "quiz_public"));
        $quiz_public->add_attribute(new lib\HTMLAttribute("value", "isPublic"));

        $quiz_comments = new lib\HTMLInputElement();
        $quiz_comments->add_attribute(new lib\HTMLAttribute("type", "checkbox"));
        $quiz_comments->add_attribute(new lib\HTMLAttribute("name", "quiz_comments"));
        $quiz_comments->add_attribute(new lib\HTMLAttribute("value", "enableComments"));

        $label1 = new lib\HTMLLabelElement();
        $label1 ->add_child(new lib\HTMLTextNode($quiz_public));
        $label1 ->add_child(new lib\HTMLTextNode("isPublic"));

        $label2 = new lib\HTMLLabelElement();
        $label2 ->add_child(new lib\HTMLTextNode($quiz_comments));
        $label2 ->add_child(new lib\HTMLTextNode("enableComments"));

        $login = new lib\HTMLInputElement();
        $login->add_attribute(new lib\HTMLAttribute("type", "submit"));
        $login->add_attribute(new lib\HTMLAttribute("name", "login"));
        $login->add_attribute(new lib\HTMLAttribute("value", "CREATE QUIZ"));
        $login->add_attribute(new lib\HTMLAttribute("style",
            "width:211px;background-color:#5ca4da;color:white;padding:14px 20px;margin:8px 0;border:none;border-radius:4px;cursor:pointer;"));


        $c1 = new lib\HTMLCellElement();
        $c1 -> add_child($quiz_name);
        $c1 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c1 -> add_attribute($center);

        $c2 = new lib\HTMLCellElement();
        $c2 -> add_child($quiz_description);
        $c2 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c2 -> add_attribute($center);

        $c3 = new lib\HTMLCellElement();
        $c3 -> add_child($quiz_file);
        $c3 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c3 -> add_attribute($center);

        $c4 = new lib\HTMLCellElement();
        $c4 -> add_child($quiz_text);
        $c4 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c4 -> add_attribute($center);

        $c5 = new lib\HTMLCellElement();
        $c5 -> add_child($label1);
        $c5 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c5 -> add_attribute($center);

        $c6 = new lib\HTMLCellElement();
        $c6 -> add_child($label2);
        $c6 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c6 -> add_attribute($center);

        $c7 = new lib\HTMLCellElement();
        $c7 -> add_child($login);
        $c7 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c7 -> add_attribute($center);

        $c_text = new lib\HTMLCellElement();
        $c_text -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c_text -> add_attribute($center);
        $c_text ->add_child(new lib\HTMLH3Element("CREATE QUIZ:"));

        $table -> add_row(new lib\HTMLRowElement([$c_text]));
        $table -> add_row(new lib\HTMLRowElement([$c1]));
        $table -> add_row(new lib\HTMLRowElement([$c2]));
        $table -> add_row(new lib\HTMLRowElement([$c3]));
        $table -> add_row(new lib\HTMLRowElement([$c4]));
        $table -> add_row(new lib\HTMLRowElement([$c5]));
        $table -> add_row(new lib\HTMLRowElement([$c6]));
        $table -> add_row(new lib\HTMLRowElement([$c7]));

        $table -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;"));

        $form->add_child($table);

        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body -> add_child($form);

        echo $body;
    }
}