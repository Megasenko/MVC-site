<?php

class ControllerBlog extends Controller
{

    public function __construct()
    {
        $this->model = new ModelBlog();
        parent::__construct();
    }

    public function indexAction()
    {
        $data = $this->model->getArticles();
        $this->view->generate('blogView.php', $data);
    }

    public function postAction($myKey)
    {
        $data = $this->model->getArticle($myKey);
        $this->view->generate('singleView.php', $data);

    }

}