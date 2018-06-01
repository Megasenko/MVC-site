<?php

class ControllerMain extends Controller
{
    function indexAction()
    {
        $this->view->generate('mainView.php', 'templateView.php');
    }
}