<?php

class ModelBlog extends Model
{
    /** Articles
     * @var
     */
    private $title;
    private $sub_title;
    private $content;
    private $created_at;
    private $url;
    private $author;
    private $role;
    private $userRole;

    /**
     * Users
     */
    private $name;
    private $last_name;
    private $login;
    private $email;
    private $password;


    /**
     * Получение всех статей
     * Get Articles
     *
     * @return array|bool
     */
    public function getArticles()
    {
        if ($this->connect()) {

            $sql = "SELECT articles.*, users.login AS authorLogin
                FROM articles 
                INNER JOIN users ON users.id = articles.author 
                WHERE articles.role='3'
                ORDER BY created_at desc
                ";

            return $this->connect()->query($sql)->fetchAll(PDO::FETCH_OBJ);
        }

        return false;
    }

    /**
     * Получение статьи по URl адрессу
     * @param $url
     * @return mixed
     */
    public function getArticle($url)
    {

        if ($this->connect()) {
            $sql = "SELECT articles.*, users.login AS authorLogin
            FROM articles 
            INNER JOIN users ON users.id = articles.author WHERE url='$url'
            ";

            return $this->connect()->query($sql)->fetch(PDO::FETCH_OBJ);
        }
    }

    /**
     * Удаление статьи
     * @param $url
     * @return bool
     */
    public function deleteArticle($url)
    {

        if ($this->connect()) {
            $sql = "DELETE FROM articles WHERE url='$url'";

            return $this->connect()->prepare($sql)->execute();
        }

        return false;
    }

    /**
     * Обновление статьи
     * @param $dataArticle
     * @param $urlArticle
     * @return bool
     */
    public function updateArticle($urlArticle)
    {


        if (isset($_POST['update'])) {
            $this->title = (isset($_POST['title'])) ? $_POST['title'] : '';
            $this->sub_title = (isset($_POST['sub_title'])) ? $_POST['sub_title'] : '';
            $this->content = (isset($_POST['content'])) ? $_POST['content'] : '';
            $this->role = (isset($_POST['role'])) ? $_POST['role'] : '';
        }

        $filePath = null;
        if (isset($_FILES)) {
            $filePath = $this->saveImage();
        }
        if ($filePath != null) {
            $article = $this->getArticle($urlArticle);
            if ($article->image) {
                unlink(__DIR__ . '/../../' . $article->image);
            }
        }

        if ($this->connect()) {
            $title = strip_tags(trim($this->title));
            $sub_title = strip_tags(trim($this->sub_title));
            $content = strip_tags(trim($this->content));
            $role = strip_tags(trim($this->role));

            $sql = "UPDATE articles SET title='$title',sub_title='$sub_title',content='$content',
              role=$role, image='$filePath'  WHERE url='$urlArticle'";

            return $this->connect()->prepare($sql)->execute();
        } else {
            header("Location : /");
            exit;
        }

    }


    /**
     * Добавление статьи в базу
     * @param $dataArticle
     * @return bool
     */
    public function insertArticle()
    {
        if (isset($_POST['add'])) {
            $this->title = (isset($_POST['title'])) ? $_POST['title'] : '';
            $this->sub_title = (isset($_POST['sub_title'])) ? $_POST['sub_title'] : '';
            $this->content = (isset($_POST['content'])) ? $_POST['content'] : '';
        }

        $filePath = null;
        if (isset($_FILES)) {
            $filePath = $this->saveImage();
        }

        if ($this->connect()) {
            $sql = "INSERT INTO articles(title , sub_title , content , created_at , url , author , role , image)
            VALUES ( :title , :sub_title , :content , :created_at , :url , :author , :role, :image)";

            $stmt = $this->connect()->prepare($sql);


            $datetime = new DateTime();
            $createdAt = $datetime->format('Y-m-d H:i:s');
            $url = $this->getUrl($this->title);
//            $author = $this->getAuthorArticle(); todo author
            $author = 1;
            $role = 1;

            $stmt->bindValue(':title', strip_tags(trim($this->title)), PDO::PARAM_STR);
            $stmt->bindValue(':sub_title', strip_tags(trim($this->sub_title)), PDO::PARAM_STR);
            $stmt->bindValue(':content', strip_tags(trim($this->content)), PDO::PARAM_STR);
            $stmt->bindValue(':created_at', $createdAt, PDO::PARAM_STR);
            $stmt->bindValue(':url', $url, PDO::PARAM_STR);
            $stmt->bindValue(':author', $author, PDO::PARAM_STR);
            $stmt->bindValue(':role', $role, PDO::PARAM_STR);
            $stmt->bindValue(':image', $filePath, PDO::PARAM_STR);

            if ($stmt->execute()) {
                header('Location:/adminPanel/articles');
                exit;
            }

        }
        return false;
    }


    /**
     * автор для статьи
     * @return mixed
     */
    public function getAuthorArticle()
    {

        if ($this->connect()) {
            $a = (isset($_SESSION['login'])) ? $_SESSION['login'] : '';
            $sql = "SELECT id
                FROM users
                WHERE login='$a'
                ";

            $row = $this->connect()->query($sql)->fetch(PDO::FETCH_ASSOC);
            return $row['id'];
        }


    }


    /**
     * получение статьи по URL
     * @param $str
     * @return bool|mixed
     *
     */
    function getArticleByUrl($str)
    {

        if ($this->connect()) {
            $sql = "SELECT *
                FROM articles
                WHERE url='$str'
                ";

            return $this->connect()->query($sql)->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }


    /**
     * поиск статьи по запросу пользователя
     * @param $search
     * @return array
     */
    function getArticleByUser($search)
    {
        $search = "%$search%";

        if ($this->connect) {
            $stm = $this->connect->prepare("SELECT * FROM articles WHERE (title LIKE '$search') 
                              OR (sub_title LIKE '$search') OR (content LIKE '$search')");
            $stm->execute(array($search));
            return $stm->fetchAll();
        }

    }


//    /**
//     * вывод статей по роли пользователя
//     * @param $role
//     * @return mixed
//     */
//    function getArticlesRole($role)
//    {
//
//        if ($this->connect) {
//            $sql = "SELECT *
//                FROM articles WHERE role='$role'";
//
//            return $this->connect->query($sql)->fetchAll(PDO::FETCH_OBJ);
//        }
//    }

    /**
     * генерируем URL
     * @param $str
     * @return mixed|string
     */
    private function getUrl($str)
    {
        $articleUrl = str_replace(' ', '-', $str);
        $articleUrl = $this->transliteration($articleUrl);
        $articleIsset = $this->getArticleByUrl($articleUrl);
        if (!$articleIsset) {
            return $articleUrl;
        } else {
            $url = $articleIsset['url'];
            $exUrl = explode('-', $url);
            if ($exUrl) {
                $temp = (int)end($exUrl);
                $newUrl = $exUrl[0] . '-' . ++$temp;
            } else {
                $temp = 0;
                $newUrl = $articleUrl . '-' . ++$temp;
            }

            return $this->getUrl($newUrl);
        }
    }


    /**
     *  перевод тектса
     * @param $str
     * @return string
     */
    private function transliteration($str)
    {
        $st = strtr($str,
            array(
                'а' => 'a',
                'б' => 'b',
                'в' => 'v',
                'г' => 'g',
                'д' => 'd',
                'е' => 'e',
                'ё' => 'e',
                'ж' => 'zh',
                'з' => 'z',
                'и' => 'i',
                'к' => 'k',
                'л' => 'l',
                'м' => 'm',
                'н' => 'n',
                'о' => 'o',
                'п' => 'p',
                'р' => 'r',
                'с' => 's',
                'т' => 't',
                'у' => 'u',
                'ф' => 'ph',
                'х' => 'h',
                'ы' => 'y',
                'э' => 'e',
                'ь' => '',
                'ъ' => '',
                'й' => 'y',
                'ц' => 'c',
                'ч' => 'ch',
                'ш' => 'sh',
                'щ' => 'sh',
                'ю' => 'yu',
                'я' => 'ya',
                ' ' => '_',
                '<' => '_',
                '>' => '_',
                '?' => '_',
                '"' => '_',
                '=' => '_',
                '/' => '_',
                '|' => '_'
            )
        );
        $st2 = strtr($st,
            array(
                'А' => 'a',
                'Б' => 'b',
                'В' => 'v',
                'Г' => 'g',
                'Д' => 'd',
                'Е' => 'e',
                'Ё' => 'e',
                'Ж' => 'zh',
                'З' => 'z',
                'И' => 'i',
                'К' => 'k',
                'Л' => 'l',
                'М' => 'm',
                'Н' => 'n',
                'О' => 'o',
                'П' => 'p',
                'Р' => 'r',
                'С' => 's',
                'Т' => 't',
                'У' => 'u',
                'Ф' => 'ph',
                'Х' => 'h',
                'Ы' => 'y',
                'Э' => 'e',
                'Ь' => '',
                'Ъ' => '',
                'Й' => 'y',
                'Ц' => 'c',
                'Ч' => 'ch',
                'Ш' => 'sh',
                'Щ' => 'sh',
                'Ю' => 'yu',
                'Я' => 'ya'
            )
        );
        $translit = $st2;

        return $translit;
    }


    /**
     * Все что касается пользователей
     */
    public function getUsers()
    {
        if ($this->connect()) {
            $sql = "SELECT *
                FROM users
                ";

            return $this->connect()->query($sql)->fetchAll(PDO::FETCH_OBJ);
        }
    }

    /**
     * Добавление пользователей в базу при регистрации
     * @return bool
     */
    public function insertUser()
    {
        if (isset($_POST['add'])) {
            $this->name = (isset($_POST['name'])) ? $_POST['name'] : '';
            $this->last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
            $this->login = (isset($_POST['login'])) ? $_POST['login'] : '';
            $this->email = (isset($_POST['email'])) ? $_POST['email'] : '';
            $this->password = (isset($_POST['password'])) ? $_POST['password'] : '';
        }

        if ($this->connect()) {
            $userRole = 3;
            $password = md5($this->password);

            $sql = "INSERT INTO users(name, last_name, login , email , password, role)
        VALUES ( :name, :last_name , :login , :email , :password , :role)";

            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $this->last_name, PDO::PARAM_STR);
            $stmt->bindParam(':login', $this->login, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':role', $userRole, PDO::PARAM_STR);
            if ($stmt->execute()) {
                header('Location:/adminPanel/users');
            }


        }
        return false;
    }


    /**
     *  Удаление пользователя
     * @param $id
     * @return bool
     */
    public function deleteUser($id)
    {

        if ($this->connect()) {
            $sql = "DELETE FROM users WHERE id=$id";

            return $this->connect()->prepare($sql)->execute();
        }

        return false;
    }

    /**
     * обновление информации о пользователе или установка роли
     * @param $userData
     * @param $id
     * @return bool
     *
     */
    public function updateRole($id)
    {

        if (isset($_POST['updateRole'])) {
            $this->userRole = (isset($_POST['role'])) ? $_POST['role'] : '';
        }
        if ($this->connect()) {
            $role = $this->userRole;

            $sql = "UPDATE users SET role=$role WHERE id='$id'";

            return $this->connect()->prepare($sql)->execute();
        } else {
            header("Location : /");
            exit;
        }

    }

    /**
     * Доступ на страничку только админу
     */
    public function accessAdmin()
    {
        if ($_SESSION['role'] !== 1) {
            header('Location: /');
            exit;
        }
    }

    /**
     * Выбор одного пользователя по id
     * @param $id
     * @return array
     *
     */
    public function getUser($id)
    {

        if ($this->connect()) {
            $sql = "SELECT *
            FROM users WHERE id='$id'";
            return $this->connect()->query($sql)->fetch(PDO::FETCH_OBJ);
        }
    }


    function getErrorMessage()
    {
        return $_SESSION['error_message'] ?? false;
    }


}