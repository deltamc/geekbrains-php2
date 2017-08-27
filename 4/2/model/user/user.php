<?php

class User
{
    private $user = array();
    private $sessionKey;

    function __construct($sessionKey)
    {
        $this->sessionKey = $sessionKey;
    }

    public function login ($login, $password)
    {

        $password = $this->hashPass($password);

        $login = escapeString($login);

        $sql = "SELECT `id`, `name`, `login` FROM `user` WHERE `login` = '{$login}' AND `password` = '{$password}'";

        $this->user = getAssocResultOne($sql);

        if (!empty($this->user)) {
            session_start();
            $_SESSION[$this->sessionKey]['id']         = $this->user['id'];
            $_SESSION[$this->sessionKey]['name']       = $this->user['name'];
            $_SESSION[$this->sessionKey]['login']      = $this->user['login'];
            $_SESSION[$this->sessionKey]['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

            return true;
        }

        return false;
    }

    private function hashPass($password)
    {
        /*
        $salt = 'asdkljhf78yaesw8ft28gf8asgf8i2gqf82737gaigs78';
        $salt2 = 'sdf899ty7d7856fgy32fg78g';
        return md5(md5($salt2 . $password . $salt));
        */

        return escapeString($password);
    }

    public function isLogin()
    {
        if(isset($_SESSION[$this->sessionKey]) ||
            $_SESSION[$this->sessionKey]['user_agent'] == $_SERVER['HTTP_USER_AGENT']
        ) {
            return true;
        }

        return false;
    }

    public function getUser()
    {

        if($this->isLogin()){
            $this->user = $_SESSION[$this->sessionKey];
        }
        return $this->user;
    }

    public function logOut()
    {
        $this->user = array();
        unset($_SESSION[$this->sessionKey]);
    }
}