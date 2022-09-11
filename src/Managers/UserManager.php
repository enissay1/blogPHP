<?php
namespace App\Managers;
use App\Entity\User;
use App\Services\Connection;

class UserManager
{
    private $pdo;
    public function __construct()
    {
        $this->pdo =  Connection::getInstance()->getPdo();
    }
    public function add($email,$username,$hash)
    {
        $password=password_hash($hash, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user(email, username, password) VALUES (:email,:username,:password)";
        $result=$this->pdo->prepare($sql);
        //dump($result);die();
        $result->execute(array("email"=>$email,
                                "username"=>$username,
                                "password"=>$password,                      
            ));
    }


    public function update($id, $email,$username,$hash)
    {
        $password=password_hash($hash, PASSWORD_DEFAULT);

        $sql = "UPDATE User
        SET id = :id, username = :username,email = :email,password = :password
        WHERE id=:id";

        $result = $this->pdo->prepare($sql);
        $result->execute(array(
            "id" => $id,
            "username" => $username,
            "email" => $email,
            "password" => $password,
        ));
    }

    public function delete($username)
    {
        $sql = "DELETE FROM User WHERE username=:username";

        $result = $this->pdo->prepare($sql);
        $result->execute(array("username" => $username));
    }


    public function find($id)
    {
        //search with id or username or email in param
        $sql = "SELECT * FROM User WHERE id=:id OR email=:id OR username=:id";

        $result = $this->pdo->prepare($sql);
        $result->execute(array("id" => $id,"email" => $id,"username" => $id
    
    ));
        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public function findAll()
    {
        $sql = "SELECT * FROM User ";

        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function findAllWithClass()
    {
        $sql = "SELECT * FROM User ";

        $result = $this->pdo->prepare($sql);
        $result->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $result->execute();
        return $result->fetchALL();
    }



}
?>
