<?php


namespace view;
use lib;

class AccountView extends AbstractView
{
    public function __construct(private array $user, private array $data)
    {
    }

    public function generateHTML()
    {
        $body = new lib\HTMLBodyElement();
        $table = new lib\HTMLTableElement();
        $table2 = new lib\HTMLTableElement();

        $center = new lib\HTMLAttribute("style", "text-align:center;");
        $left = new lib\HTMLAttribute("style", "text-align:left;");
        $right = new lib\HTMLAttribute("style", "text-align:right;");
        $table -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;border-collapse:separate;border: 0px solid black;border-radius:20px;-moz-border-radius:6px;"));
        $table2 -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;border-collapse:separate;border: 2px solid black;"));

        $c_empty = new lib\HTMLCellElement();

        $form = new lib\HTMLFormElement();
        $form->add_attribute(new lib\HTMLAttribute("action", "/account/edit"));
        $form->add_attribute(new lib\HTMLAttribute("method", "post"));

        $login = new lib\HTMLInputElement();
        $login->add_attribute(new lib\HTMLAttribute("type", "submit"));
        $login->add_attribute(new lib\HTMLAttribute("name", "login"));
        $login->add_attribute(new lib\HTMLAttribute("value", "EDIT"));
        $login->add_attribute(new lib\HTMLAttribute("style",
            "width:120px;background-color:#5ca4da;color:white;padding:14px 20px;margin:8px 0;border:none;border-radius:4px;cursor:pointer;"));

        $form->add_child($login);
        $c_form = new lib\HTMLCellElement($form);

        $a1 = new lib\HTMLH3Element("DATE OF BIRTH:");
        $c1 = new lib\HTMLCellElement();
        $c1 -> add_child($a1);
        $c1 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c1 -> add_attribute($right);

        $a2 = new lib\HTMLH3Element($this->user["date_of_birth"]);
        $c2 = new lib\HTMLCellElement();
        $c2 -> add_child($a2);
        $c2 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c2 -> add_attribute($center);

        $table -> add_row(new lib\HTMLRowElement([$c1, $c2, $c_empty]));

        $a3 = new lib\HTMLH3Element("E-MAIL:");
        $c3 = new lib\HTMLCellElement();
        $c3 -> add_child($a3);
        $c3 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c3 -> add_attribute($right);

        $a4 = new lib\HTMLH3Element($this->user["email"]);
        $c4 = new lib\HTMLCellElement();
        $c4 -> add_child($a4);
        $c4 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c4 -> add_attribute($center);

        $table -> add_row(new lib\HTMLRowElement([$c3, $c4, $c_form]));

        $a5 = new lib\HTMLH3Element("PASSWORD:");
        $c5 = new lib\HTMLCellElement();
        $c5 -> add_child($a5);
        $c5 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c5 -> add_attribute($right);

        $a6 = new lib\HTMLH3Element("**********");
        $c6 = new lib\HTMLCellElement();
        $c6 -> add_child($a6);
        $c6 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c6 -> add_attribute($center);

        $table -> add_row(new lib\HTMLRowElement([$c5, $c6, $c_empty]));

        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body -> add_child($table);

        ###############################
        ####ISPIS RJEŠENIH KVIZOVA#####
        ###############################

        $h1 = new lib\HTMLTableHeadElement();
        $h1 -> add_child(new lib\HTMLTextNode("QUIZ NAME"));
        $h2 = new lib\HTMLTableHeadElement();
        $h2 -> add_child(new lib\HTMLTextNode("ATTEMPTS"));
        $h3 = new lib\HTMLTableHeadElement();
        $h3 -> add_child(new lib\HTMLTextNode("AVERAGE SCORE"));

        $table2 -> add_row(new lib\HTMLRowElement([$h1, $h2, $h3]));

        foreach ($this->data as $quiz) {
            $t1 = new lib\HTMLCellElement();
            $t1->add_child(new lib\HTMLTextNode($quiz[0]));
            $t1->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));

            $t2 = new lib\HTMLCellElement();
            $t2->add_child(new lib\HTMLTextNode($quiz[1]));
            $t2->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));

            $t3 = new lib\HTMLCellElement();
            $t3->add_child(new lib\HTMLTextNode($quiz[2] . "%"));
            $t3->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));
            $table2->add_row(new lib\HTMLRowElement([$t1, $t2, $t3]));
        }


        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body -> add_child($table2);

        echo $body;
    }
}