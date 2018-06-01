<?php

class ControllerLogin extends Controller
{
    public function __construct()
    {
        $this->model = new Login();
        parent::__construct();
    }

    public function indexAction()
    {
        $this->model->auth();
        $data = $this->model->getErrorMessage();
        $this->view->generate('signInView.php', $data);
    }

    public function logoutAction()
    {
        $this->model->logout();
        $data = $this->model->getErrorMessage();
        $this->view->generate('signInView.php', $data);
    }

    public function registerAction()
    {
        $this->model->registerUser();
        $data = $this->model->getErrorMessage();
        $this->view->generate('signUpView.php', $data);
    }
}
