<?php

namespace App\Managers;

use App\Entity\Comment;
use App\Services\Connection;

class CommentManager
{
    private $pdo;
    public function __construct()
    {
        $this->pdo =  Connection::getInstance()->getPdo();
    }
    public function add($pseudo,$content,$id_post)
    {
        $sql = "INSERT INTO comment SET pseudo=:pseudo,content=:content,createdAt=:createdAt,id_post=:id_post";
        $result = $this->pdo->prepare($sql);
        $result->execute(array("pseudo" => $pseudo,
                                "content"=>$content,
                                "id_post"=>$id_post,
                                "createdAt"=>date("Y-m-d")
    ));
    }


    public function update($id, $pseudo,$content)
    {
        $sql = "UPDATE comment
        SET id=:id,pseudo=:pseudo,content=:content WHERE id=:id";

        $result = $this->pdo->prepare($sql);
        $result->execute(array(
            "id" => $id,
            "pseudo" => $pseudo,
            "content" => $content,

        ));
    }
    public function delete($id)
    {
        $sql = "DELETE FROM comment WHERE id=:id";

        $result = $this->pdo->prepare($sql);
        $result->execute(array("id" => $id));
    }
    public function find($id)
    {
        $sql = "SELECT * FROM comment WHERE id=:id OR pseudo=:id";

        $result = $this->pdo->prepare($sql);
        $result->execute(array("id" => $id,
                                "pseudo"=>$id
    ));
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
    public function findAll()
    {
        $sql = "SELECT * FROM comment ";

        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function findAllClass()
    {
        $sql = "SELECT * FROM comment ";

        $result = $this->pdo->prepare($sql);
        $result->setFetchMode(\PDO::FETCH_CLASS, Category::class);
        $result->execute();
        return $result->fetchALL();
    }
}
