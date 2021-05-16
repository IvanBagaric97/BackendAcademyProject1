<?php


namespace controller;
use view;

class RegisterController extends AbstractController
{
    public function doAction() : void
    {
        $h = new view\RegisterView();
        $h -> generateHTML();
    }
}