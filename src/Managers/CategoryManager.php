<?php

namespace App\Managers;

use App\Entity\Category;
use App\Services\Connection;

class CategoryManager
{
    private $pdo;
    public function __construct()
    {
        $this->pdo =  Connection::getInstance()->getPdo();
    }
    public function add($name)
    {
        $sql = "INSERT INTO category SET name=:name";
        $result = $this->pdo->prepare($sql);
        $result->execute(array("name" => $name));
    }


    public function update($id, $name)
    {
        $sql = "UPDATE category
        SET name = :name
        WHERE id=:id";

        $result = $this->pdo->prepare($sql);
        $result->execute(array(
            "id" => $id,
            "name" => $name,
        ));
    }
    public function delete($name)
    {
        $sql = "DELETE FROM category WHERE name=:name";

        $result = $this->pdo->prepare($sql);
        $result->execute(array("name" => $name));
    }
    public function find($id)
    {
        $sql = "SELECT * FROM category WHERE id=:id OR name=:id";

        $result = $this->pdo->prepare($sql);
        $result->execute(array("id" => $id,
                                "name"=>$id
    ));
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
    public function findAll()
    {
        $sql = "SELECT * FROM category ";

        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function findAllClass()
    {
        $sql = "SELECT * FROM category ";

        $result = $this->pdo->prepare($sql);
        $result->setFetchMode(\PDO::FETCH_CLASS, Category::class);
        $result->execute();
        return $result->fetchALL();
    }
    public function searchcategory(){
        $sql="SELECT title FROM category";
    $query=$pdo->query($sql,PDO::FETCH_ASSOC);
    $results=$query->fetchAll();
    // get the q parameter from URL
    var_dump($_GET);
    $q = $_REQUEST["q"];
    
    $hint = "";
    
    // lookup all hints from array if $q is different from ""
    if ($q !== "") {
      $q = strtolower($q);
      $len=strlen($q);
      foreach($results as $name) {
        if (stristr($q, substr($name['name'], 0, $len))) {
          if ($hint === "") {
            $hint = "<a href='#'>{$name['name']}</a>";
          } else {
            $hint .= "<br><a>{$name['name']}</a>";
          }
        }
        //echo$name['title'];
      }
    }
    
    // Output "no suggestion" if no hint was found or output correct values
    echo $hint === "" ? "no suggestion" : $hint;
      }
}
