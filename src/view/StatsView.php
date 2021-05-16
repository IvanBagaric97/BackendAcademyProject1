<?php


namespace view;
use lib;


class StatsView extends AbstractView
{
    public function __construct(private array $values, private array $owned_by)
    {
    }

    public function generateHTML()
    {
        $body = new lib\HTMLBodyElement();
        $table = new lib\HTMLTableElement();
        $table2 = new lib\HTMLTableElement();
        $center = new lib\HTMLAttribute("style", "text-align:center;");
        $table -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;border-collapse:separate;border: 2px solid black;"));
        $table2 -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;border-collapse:separate;border: 2px solid black;"));

        $h1 = new lib\HTMLTableHeadElement();
        $h1 -> add_child(new lib\HTMLTextNode("QUIZ NAME"));
        $h2 = new lib\HTMLTableHeadElement();
        $h2 -> add_child(new lib\HTMLTextNode("MIN"));
        $h3 = new lib\HTMLTableHeadElement();
        $h3 -> add_child(new lib\HTMLTextNode("MAX"));
        $h4 = new lib\HTMLTableHeadElement();
        $h4 -> add_child(new lib\HTMLTextNode("AVG"));
        $h5 = new lib\HTMLTableHeadElement();
        $h5 -> add_child(new lib\HTMLTextNode("STD"));
        $h6 = new lib\HTMLTableHeadElement();
        $h6 -> add_child(new lib\HTMLTextNode("MED"));

        $table -> add_row(new lib\HTMLRowElement([$h1, $h2, $h3, $h4, $h5, $h6]));
        $table2 -> add_row(new lib\HTMLRowElement([$h1, $h2, $h3, $h4, $h5, $h6]));

        foreach($this->values as $key=>$value){
            $t1 = new lib\HTMLCellElement();
            $t1->add_child(new lib\HTMLTextNode($key));
            $t1->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));

            $t2 = new lib\HTMLCellElement();
            $t2->add_child(new lib\HTMLTextNode($value[0]));
            $t2->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));

            $t3 = new lib\HTMLCellElement();
            $t3->add_child(new lib\HTMLTextNode($value[1]));
            $t3->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));

            $t4 = new lib\HTMLCellElement();
            $t4->add_child(new lib\HTMLTextNode($value[2]));
            $t4->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));

            $t5 = new lib\HTMLCellElement();
            $t5->add_child(new lib\HTMLTextNode($value[3]));
            $t5->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));

            $t6 = new lib\HTMLCellElement();
            $t6->add_child(new lib\HTMLTextNode($value[4]));
            $t6->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));

            if($this->owned_by[$key] == $_SESSION["id"]) {
                $table -> add_row(new lib\HTMLRowElement([$t1, $t2, $t3, $t4, $t5, $t6]));
            }else{
                $table2 -> add_row(new lib\HTMLRowElement([$t1, $t2, $t3, $t4, $t5, $t6]));
            }
        }
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLH3Element("OWNED BY ME:"));
        $body -> add_child($table);
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLH3Element("OWNED BY OTHER:"));
        $body -> add_child($table2);

        echo $body;
    }
}