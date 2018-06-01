<?php

class ControllerAdminPanel extends Controller
{
    public function __construct()
    {
        if(!isset($_SESSION['role']) || $_SESSION['role']!=1){
            header('Location:/');
        } else {
            $this->model = new AdminPanel();
            parent::__construct();
        }


    }

    public function indexAction()
    {
        $this->view->generate('adminView.php', $data = null, $templateView = 'adminTemplateView.php');
    }

    /**
     * view all articles in table
     */
    public function articlesAction()
    {
        $data = $this->model->getArticles();
        $this->view->generate('adminArticlesView.php', $data, $templateView = 'adminTemplateView.php');

    }

    /**
     * Add article
     */
    public function addArticleAction()
    {
        if(isset($_POST['add'])){
            $this->model->insertArticle();
        }
        $this->view->generate('adminAddArticleView.php', $data = null, $templateView = 'adminTemplateView.php');

    }

    /** View article before update
     * @param $url
     */
    public function editArticleAction($url)
    {
        $data = $this->model->getArticle($url);
        $this->view->generate('adminUpdateArticleView.php', $data, $templateView = 'adminTemplateView.php');

    }

    /** Update article
     * @param $url
     */
    public function updateArticleAction($url)
    {
        if ($this->model->updateArticle($url)) {
            $data = $this->model->getArticles();
            $this->view->generate('adminArticlesView.php', $data, $templateView = 'adminTemplateView.php');
        }
    }

    /** Delete article
     * @param $url
     */
    public function delArticleAction($url)
    {
        $this->model->deleteArticle($url);
        $data = $this->model->getArticles();
        $this->view->generate('adminArticlesView.php', $data, $templateView = 'adminTemplateView.php');

    }


    public function usersAction()
    {
        $data = $this->model->getUsers();
        $this->view->generate('adminUsersView.php', $data, $templateView = 'adminTemplateView.php');

    }

    public function addUserAction()
    {
        $this->model->insertUser();
        $this->view->generate('adminAddUserView.php', $data = null, $templateView = 'adminTemplateView.php');

    }

    public function editUserAction($id)
    {
        $data = $this->model->getUser($id);
        $this->view->generate('adminUpdateUserView.php', $data, $templateView = 'adminTemplateView.php');

    }

    public function updateUserAction($id)
    {
        if( $this->model->updateRole($id)) {
            $data = $this->model->getUsers();
            $this->view->generate('adminUsersView.php', $data, $templateView = 'adminTemplateView.php');
        }
    }

    public function delUserAction($id)
    {
        $this->model->deleteUser($id);
        $data = $this->model->getUsers();
        $this->view->generate('adminUsersView.php', $data, $templateView = 'adminTemplateView.php');

    }

    public function ajaxAction()
    {
        echo $this->model->delImage($_POST['urlImage']);
    }



}
