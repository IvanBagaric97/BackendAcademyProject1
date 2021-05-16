<?php


namespace view;


class AccessView extends AbstractView
{

    public function generateHTML()
    {
        echo "Access denied. To gain access you have to log in!";
    }
}