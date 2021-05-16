<?php


namespace view;
use lib;

class HeaderView extends AbstractView
{
    public function __construct(private string $e)
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
        $table -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;border-collapse:separate;border: 2px solid black;border-radius:20px;-moz-border-radius:6px;"));
        $table2 -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;border-collapse:separate;border: 2px solid black;border-radius:20px;-moz-border-radius:6px;"));


        $design = new lib\HTMLImageElement("/resources/design.png");
        $design -> add_attribute(new lib\HTMLAttribute("style", "width:60px"));
        $a1 = new lib\HTMLAElement("/home", "");
        $a1 -> add_child($design);

        $c1 = new lib\HTMLCellElement();
        $c1 -> add_child($a1);
        $c1 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c1 -> add_attribute($left);

        $design2 = new lib\HTMLImageElement("/resources/settings.png");
        $design2 -> add_attribute(new lib\HTMLAttribute("style", "width:50px"));
        $a2 = new lib\HTMLAElement("/account", "");
        $a2 -> add_child($design2);

        $c_empty = new lib\HTMLCellElement();

        $c2 = new lib\HTMLCellElement();
        $c2 -> add_child($a2);
        $c2 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c2 -> add_attribute($right);

        $text = new lib\HTMLH3Element($this->e);
        $text->add_attribute(new lib\HTMLAttribute("style", "color:black;font-size: 20px;"));

        $c3 = new lib\HTMLCellElement();
        $c3 -> add_child($text);
        $c3 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c3 -> add_attribute(new lib\HTMLAttribute("style", "vertical-align: bottom;"));
        #$c3 -> add_attribute($left);

        $design3 = new lib\HTMLImageElement("/resources/power.png");
        $design3 -> add_attribute(new lib\HTMLAttribute("style", "width:50px"));
        $a3 = new lib\HTMLAElement("/logout", "");
        $a3 -> add_child($design3);

        $c4 = new lib\HTMLCellElement();
        $c4 -> add_child($a3);
        $c4 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $c4 -> add_attribute($right);

        ################################################################################################################

        $des1 = new lib\HTMLImageElement("/resources/create.png");
        $des1 -> add_attribute(new lib\HTMLAttribute("style", "width:60px"));
        $l1 = new lib\HTMLAElement("/create", "");
        $l1 -> add_child($des1);

        $cb1 = new lib\HTMLCellElement();
        $cb1 -> add_child($l1);
        $cb1 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $cb1 -> add_attribute($center);

        $des2 = new lib\HTMLImageElement("/resources/view.png");
        $des2 -> add_attribute(new lib\HTMLAttribute("style", "width:60px"));
        $l2 = new lib\HTMLAElement("/view", "");
        $l2 -> add_child($des2);

        $cb2 = new lib\HTMLCellElement();
        $cb2 -> add_child($l2);
        $cb2 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $cb2 -> add_attribute($center);

        $des3 = new lib\HTMLImageElement("/resources/stats.png");
        $des3 -> add_attribute(new lib\HTMLAttribute("style", "width:60px"));
        $l3 = new lib\HTMLAElement("/stats", "");
        $l3 -> add_child($des3);

        $cb3 = new lib\HTMLCellElement();
        $cb3 -> add_child($l3);
        $cb3 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $cb3 -> add_attribute($center);

        $des4 = new lib\HTMLImageElement("/resources/challenge.png");
        $des4 -> add_attribute(new lib\HTMLAttribute("style", "width:60px"));
        $l4 = new lib\HTMLAElement("/challenge", "");
        $l4 -> add_child($des4);

        $cb4 = new lib\HTMLCellElement();
        $cb4 -> add_child($l4);
        $cb4 -> add_attribute(new lib\HTMLAttribute("height", "50px"));
        $cb4 -> add_attribute($center);

        $table -> add_row(new lib\HTMLRowElement([$c1, $c_empty, $c2, $c3, $c4]));
        $table2 -> add_row(new lib\HTMLRowElement([$cb1, $cb2, $cb3, $cb4]));
        $body -> add_child($table);
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body -> add_child($table2);

        echo $body;
    }
}