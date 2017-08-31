<?php
class UserController extends Controller
{

    public $view = 'user';
    public $title;
    private $user;
    public function index($data)
    {
        return array();
    }

    function __construct()
    {
        $this->user = new User('user');
        parent::__construct();
    }

    public function login($data)
    {

        $this->title = 'Вход в кабинет';
        if ($this->user->isLogin()) {
            header("Location: /?path=user/cabinet");
            exit;
        }

        $message = '';

        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $result = $this->user->login($login, $password);

            if ($result) {
                header("Location: /?path=user/cabinet");
                exit;
            }
            $message = 'Неверный пароль или логин';
        }

        return array('message' => $message);
    }

    public function cabinet($data)
    {

        $this->title = 'Кабинет начальника';
        return array();
    }

    public function logOut($data)
    {
        $this->user->logOut();
        header("Location: /");
        exit;
    }
}