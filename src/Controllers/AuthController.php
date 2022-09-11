<?php
namespace App\Controllers;
use App\Services\Authenticator;

class AuthController
{

    private $authenticator;
    private $username;
    public function __construct()
    {
        if (isset($_POST['username'])){
            $this->username=$_POST['username'];
            $this->authenticator = new Authenticator($this->username);
        }else $this->authenticator = new Authenticator($this->username);


    }

    public function getSession()
    {

        if (isset($_POST["username"]) && !empty($_POST["password"])) {
            $pass = $this->authenticator->valid($_POST["password"]);
            if ($pass==true){
                $this->authenticator->StartSession($_POST["username"],$_POST["password"]);
            }
        }
    }
    public function logout(){
        dump($this->username);
         $this->authenticator->CloseSession();
        return dump($_SESSION);
    }
}
