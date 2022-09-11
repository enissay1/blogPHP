<?php

namespace App\Managers;

use App\Entity\Post;
use App\Services\Connection;

class PostManager
{
    private $pdo;
    public function __construct()
    {
        $this->pdo =  Connection::getInstance()->getPdo();
    }
    public function uploadCover()
    {

        //target 
        $target_dir = "images/book/";
        $target_file = $target_dir . basename($_FILES["cover"]["name"]);

        $errors = array();
        $file_name = $_FILES['cover']['name'];
        $file_size = $_FILES['cover']['size'];
        $file_tmp = $_FILES['cover']['tmp_name'];
        $file_type = $_FILES['cover']['type'];

        // check if is image 
        if (isset($_POST["submit"])) {

            $check = getimagesize($_FILES["cover"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $errors[] = "File is not an image.";
                $uploadOk = 0;
            }
        }
        //check extension
        $ext = (explode('.', $_FILES['cover']['name']));
        $file_ext = strtolower(end($ext));
        $extensions = array("jpg", "jpeg", "png", "svg", "pdf");
        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a pdf or jpeg file.";
            $uploadOk = 0;

        }
        //check size
        if ($file_size > 2097152) {
            $errors[] = 'File size must be less than 2 MB';
            $uploadOk = 0;
        }
        //check exist
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        ////check errors
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../public/images/book/" . $file_name);

            return  true;
        } else return $errors;
    }
    public function add($title, $createdAt, $publishedAt, $description, $basename, $id_category, $id_user)
    {
        if ($this->uploadCover() == true) {
            if (isset($_POST["title"]) && !empty($_FILES["cover"]["name"])) {

                $title = $_POST["title"];
                $description = $_POST["description"];

                $basename=basename($_FILES["cover"]["name"]);
                //ump($basename);die();
                $path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "public". DIRECTORY_SEPARATOR ."images\book" . DIRECTORY_SEPARATOR;
                $cover = $path . $basename;
                //var_dump($cover);die();
                $sql = "INSERT INTO post SET title=:title,createdAt=:createdAt,publishedAt=:publishedAt,description=:description,cover=:cover,id_category=:id_category,id_user=:id_user";
                $result = $this->pdo->prepare($sql);
                $result->execute(array(
                    "title" => $title,
                    "createdAt" => $createdAt,
                    "publishedAt" => $publishedAt,
                    "description" => $description,
                    "cover" => $cover,
                    "id_category" => $id_category,
                    "id_user" => $id_user
                ));
            }
        }else print_r($this->uploadCover()) ;
    }



    public function update($id, $title, $createdAt, $publishedAt, $description, $cover, $id_category, $id_user)
    {
        $sql = "UPDATE post
        SET title=:title,createdAt=:createdAt,publishedAt=:publishedAt,
        description=:description,cover=:cover,id_category=:id_category,id_user=:id_user 
        WHERE id=:id";

        $result = $this->pdo->prepare($sql);
        $result->execute(array(
            "id" => $id,
            "title" => $title,
            "createdAt" => $createdAt,
            "publishedAt" => $publishedAt,
            "description" => $description,
            "cover" => $cover,
            "id_category" => $id_category,
            "id_user" => $id_user
        ));
    }
    public function delete($title)
    {
        $sql = "DELETE FROM post WHERE title=:title";

        $result = $this->pdo->prepare($sql);
        $result->execute(array("title" => $title));
    }
    public function find($id)
    {
        $sql = "SELECT * FROM post WHERE id=:id OR title=:id";

        $result = $this->pdo->prepare($sql);
        $result->execute(array(
            "id" => $id,
            "title" => $id
        ));
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
    public function findAll()
    {
        $sql = "SELECT * FROM post ";

        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function findAllClass()
    {
        $sql = "SELECT * FROM post ";

        $result = $this->pdo->prepare($sql);
        $result->setFetchMode(\PDO::FETCH_CLASS, Category::class);
        $result->execute();
        return $result->fetchALL();
    }
}
