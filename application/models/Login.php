<?php

class Login extends Model
{
    private $name;
    private $last_name;
    private $login;
    private $email;
    private $password;
    private $passwordConfirm;
    private $role;

    /**
     * Добавление пользователей в базу при регистрации
     * @return bool
     */
    public function insertUser()
    {
        if (isset($_POST['register'])) {
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
            return $stmt->execute();

        }
        return false;
    }

    /**
     * Регистрация пользователей
     *
     * @return bool|void
     */
    public function registerUser()
    {

        if (isset($_POST['register'])) {
            $this->name = (isset($_POST['name'])) ? $_POST['name'] : '';
            $this->last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
            $this->login = (isset($_POST['login'])) ? $_POST['login'] : '';
            $this->email = (isset($_POST['email'])) ? $_POST['email'] : '';
            $this->password = (isset($_POST['password'])) ? $_POST['password'] : '';
            $this->passwordConfirm = (isset($_POST['passwordConfirm'])) ? $_POST['passwordConfirm'] : '';
            $this->role = (isset($_POST['role'])) ? $_POST['role'] : '';


            if (!isset($this->login) || empty ($this->login)) {
                $_SESSION['error_message'] = 'Login can not be empty';
                return;
            }
            if (!isset($this->email) || empty ($this->email)) {
                $_SESSION['error_message'] = 'Email can not be empty';
                return;
            }
            if (!isset($this->password) || empty ($this->passwordConfirm)) {
                $_SESSION['error_message'] = 'Password can not be empty';
                return;
            }
            if ($this->password !== $this->passwordConfirm) {
                $_SESSION['error_message'] = 'Inputted passwords not confirm!';
                return;
            }

            if ($this->insertUser()) {
                $_SESSION['error_message'] = false;
                header('Location:/');
            } else {
                $_SESSION['error_message'] = 'Register user not complete';
            }
        }
    }


    /**
     * Извлечение пользователя с базы по логину
     *
     * @return array
     *
     */
    public function getLogin()
    {

        if ($this->connect()) {
            $sql = 'SELECT * FROM users WHERE login = :login';

            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }


    function getErrorMessage()
    {
        return $_SESSION['error_message'] ?? false;
    }

    /**
     * Вход пользователя на сайт и добавление значений в сессию
     *
     *
     */
    public function auth()
    {
        $_SESSION['access'] = false;
        if (isset($_POST['log'])) {
            $this->login = (isset($_POST['login'])) ? $_POST['login'] : '';
            $this->password = (isset($_POST['password'])) ? $_POST['password'] : '';

            if (!isset($this->login) || empty ($this->login)) {
                $_SESSION['error_message'] = 'Login can not be empty';
                return;
            }
            if (!isset($this->password) || empty ($this->password)) {
                $_SESSION['error_message'] = 'Password can not be empty';
                return;
            }
            if ($this->getLogin()) {
                $rows = $this->getLogin();
                if (count($rows) > 0) {
                    if (md5($this->password) == $rows[0]['password']) {
                        if ($rows[0]['login'] === 'admin') {
                            $_SESSION['access'] = true;
                            $role = $rows[0]['role'] * 1;
                            $_SESSION['role'] = $role;
                            $_SESSION['name'] = $rows[0]['name'];
                            header('Location:/adminPanel');
                            exit;
                        } else {
                            $_SESSION['access'] = true;
                            $_SESSION['role'] = $rows[0]['role'];
                            $_SESSION['name'] = $rows[0]['name'];
                            header('Location:/');
                            exit;
                        }

                    } else {
                        $_SESSION['error_message'] = 'You entered the wrong password ';
                    }
                }
            } else {
                $_SESSION['error_message'] = 'Логин <b>' . $this->login . '</b> не найден!';
            }
        }
    }


    public function logout()
    {
        session_destroy();
        header('Location:/Login');
        exit;

    }


    function viewTitle()
    {
        $arr = explode('.', $_SERVER['REQUEST_URI']);
        $str = substr($arr[0], 1);
        if ($str) {
            echo 'MVC site - ' . ucfirst($str);
        } else {
            echo 'MVC site';
        }
    }
}