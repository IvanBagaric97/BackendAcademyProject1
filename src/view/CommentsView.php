<?php


namespace view;
use lib;

class CommentsView extends AbstractView
{
    public function __construct(private int $quiz_id, private array $comments, private int $enable_comments)
    {
    }

    public function generateHTML()
    {
        $body = new lib\HTMLBodyElement();

        if($this -> enable_comments) {
            $form = new lib\HTMLFormElement();
            $form->add_attribute(new lib\HTMLAttribute("action", "/comment/" . $this ->quiz_id));
            $form->add_attribute(new lib\HTMLAttribute("method", "post"));
            $form->add_attribute(new lib\HTMLAttribute("enctype", "multipart/form-data"));

            $leave_comment = new lib\HTMLTextAreaElement();
            $leave_comment->add_attribute(new lib\HTMLAttribute("type", "textarea"));
            $leave_comment->add_attribute(new lib\HTMLAttribute("name", "comment"));
            $leave_comment->add_attribute(new lib\HTMLAttribute("placeholder", "Enter your comment:"));
            $leave_comment->add_attribute(new lib\HTMLAttribute("style",
                "width:500px;height:150px;box-sizing:border-box;border-radius:4px;padding:12px 20px;margin:8px 0;display:inline-block;border:1px solid #ccc;"));

            $login = new lib\HTMLInputElement();
            $login->add_attribute(new lib\HTMLAttribute("type", "submit"));
            $login->add_attribute(new lib\HTMLAttribute("name", "login"));
            $login->add_attribute(new lib\HTMLAttribute("value", "POST COMMENT"));

            $form->add_child($leave_comment);
            $form->add_child($login);

            $body-> add_child(new lib\HTMLTextNode($form));
            $body-> add_child(new lib\HTMLTextNode("<br>"));
            $body-> add_child(new lib\HTMLH3Element("COMMENTS:"));
            $body-> add_child(new lib\HTMLTextNode("<br>"));

            foreach ($this->comments as $quiz) {
                $t1 = new lib\HTMLCellElement();
                $t1->add_child(new lib\HTMLTextNode($quiz[0] . ": " . $quiz[1]));
                $t1->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:0px solid black;"));

                $table = new lib\HTMLTableElement();
                $table->add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;border-collapse:separate;border: 2px solid black;border-radius:20px;-moz-border-radius:6px;"));
                $table->add_row(new lib\HTMLRowElement([$t1]));
                $body->add_child($table);
                $body->add_child(new lib\HTMLTextNode("<br>"));
            }
        }else{
            $body->add_child(new lib\HTMLTextNode("Comments are disabled"));
        }
        echo $body;
    }
}