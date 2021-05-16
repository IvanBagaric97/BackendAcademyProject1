<?php


namespace view;
use lib;

class EvaluateView extends AbstractView
{
    public function __construct(private string $save)
    {
    }

    public function generateHTML()
    {
        lib\start_form("/home", "post");
        echo $this->save;
        echo lib\create_input(["type" => "submit", "value" => "Back to home"]);
        lib\end_form();
    }
}