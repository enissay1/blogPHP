<?php
namespace App\Services;

use App\Services\Connection;

class Authenticator
{
    private $pdo;
    private $results;

    public function __construct($username)
    {
        $this->pdo =  Connection::getInstance()->getPdo();

        $sql = "SELECT * FROM User WHERE (username=:username)";

        $result = $this->pdo->prepare($sql);
        $result->setFetchMode(\PDO::FETCH_ASSOC);
        $result->execute(array("username" => $username));
        $this->results = $result->fetch();

    }

    public function valid($password)
    {
        return password_verify($password, $this->results['password']);
    }

    public function getId()
    {
        return $this->results['id'];
    }



    public function StartSession($username, $password)
    {
        if( session_status() == PHP_SESSION_NONE ) // if session status is disabled then start the session
        {
             session_start();
        }
        $_SESSION['id'] = $this->getId();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
    }
    public function CloseSession()
    {
        if (session_status()== PHP_SESSION_NONE) {
            session_start();
        }
            session_unset();  // Vider les variables de sessions 
            session_destroy(); // Detruire la session
        
    }

    public function SetCookies($username, $password)
    {
        setcookie('username', $username, time() + 365 * 24 * 3600, null, null, false, true);
        setcookie('password', $password, time() + 365 * 24 * 3600, null, null, false, true);
    }
}
