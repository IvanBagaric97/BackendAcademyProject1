<?php


namespace view;
use lib;

class NonRegView extends AbstractView
{

    public function generateHTML()
    {
        echo("Thank you for solving the quiz !!! <br>");
        echo("For solution and more quizzes you have to be logged in. <br>");

        lib\start_form("/", "post");
        echo lib\create_input(["type" => "submit", "value" => "Index page"]);
        lib\end_form();
    }
}