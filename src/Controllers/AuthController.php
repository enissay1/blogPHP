<?php

namespace App\Controllers;

use App\Managers\UserManager;
use App\Services\Authenticator;

class AuthController
{

    private $authenticator;
    private $username;
    public function __construct()
    {
        if (isset($_POST['username'])) {
            $this->username = $_POST['username'];
            $this->authenticator = new Authenticator($this->username);
        } else $this->authenticator = new Authenticator($this->username);
    }

    public function getSession()
    {
        $user = new UserManager();
        if (isset($_POST["username"]) && !empty($_POST["password"])) {
            if ($user->find($_POST["username"])) {
                $pass = $this->authenticator->valid($_POST["password"]);
                if ($pass == true) {
                    $this->authenticator->StartSession($_POST["username"], $_POST["password"]);
                }
            }else echo"login or Pass non valid";
        }
    }
    public function logout()
    {
        //dump($this->username);
        $this->authenticator->CloseSession();
        return dump($_SESSION);
    }
}
