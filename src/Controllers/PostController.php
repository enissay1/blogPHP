<?php

namespace App\Controllers;

use App\Managers\PostManager;

class PostController
{

  private $postmanager;
  public function __construct()
  {
    $this->postmanager = new PostManager();
  }
  public function addPost()
  {
    if ($_SESSION != []) {
      if (!file_exists(dirname(dirname(__dir__)) . "/public/images/book/" . $_FILES["cover"]["name"])) {
        if (isset($_POST["title"]) && !empty($_POST["title"])) {

          $title = $this->postmanager->find($_POST["title"]);
          if ($title == false) {
            $this->postmanager->add($_POST["title"], $_POST["createdAt"], $_POST["publishedAt"], $_POST["description"], $_FILES["cover"]["name"], $_POST["id_category"], (int)$_SESSION["id"]);
            echo 'post  added';
          } else echo  "<br>this post exist try another";
        } else echo 'verify fields';
      } else echo 'this file exist';
    } else echo "you must connect before<a href='/user/loginpage'>click to login</a>";
  }

  public function updatePost()
  {
    if ($_SESSION != []) {
      //dump(file_exists(dirname(dirname(__dir__)) . "/public/images/book/" . $_FILES["cover"]["name"]));
      if (!file_exists(dirname(dirname(__dir__)) . "/public/images/book/" . $_FILES["cover"]["name"])) {
        if (isset($_POST["title"]) && !empty($_POST["id"])) {
          $id = $this->postmanager->find($_POST["id"]);
          dump($_FILES, $_POST);
          //die();
          if ($id == true) {
            $this->postmanager->update($_POST["id"], $_POST["title"], $_POST["createdAt"], $_POST["publishedAt"], $_POST["description"],  $_FILES["cover"]["name"], $_POST["id_category"], $_SESSION["id"]);
            echo 'Post  updated';
          } else echo  "<br>this id don t exist try another";
        } else echo 'verify fields';
      } else echo "file exist <a href='/post/updatepage'>back to update page and rename file</a>";
    } else echo "you must connect before<a href='/user/loginpage'>click to login</a>";
  }

  public function deletePost()
  {

    if ($_SESSION != []) {

      if (isset($_POST["id_post"])) {
        $post = $this->postmanager->find($_POST["id_post"]);
        if (is_array($post)) {
          $this->postmanager->delete((int)$_POST["id_post"]);
          echo 'post  deleted';
        } else echo  "<br>this post don t exist try another";
      } else echo 'verify fields';
    } else echo "you must connect before<a href='/user/loginpage'>click to login</a>";
  }
  public function searchPost()
  {


    $results = $this->postmanager->findAll();
    //dump($results);die();
    if (isset($_REQUEST["q"])) {
      $q = $_REQUEST["q"];
      //dump($q);   

      // lookup all hints from array if $q is different from ""
      if ($q !== "") {
        $q = strtolower($q);
        $len = strlen($q);
        $hint = "";
        foreach ($results as $name) {
          if (stristr($q, substr($name['title'], 0, $len))) {
            if ($hint === "") {
              $hint = "
              <tr>
              <td scope='row'>{$name['title']}</td>
              <td scope='row'>{$name['description']}</td>
              </tr>";
            } else {
              $hint .=  "
              <tr>
              <td scope='row'>{$name['title']}</td>
              <td scope='row'>{$name['description']}</td>
              </tr>";
            }
          }
        }
        // Output "no suggestion" if no hint was found or output correct values
        //echo $hint === "" ? "no suggestion" : $hint;
        echo "
        <thead>
          <tr>
              <th scope='col'>Title</th>
              <th scope='col'>Description</th>
          </tr>
      </thead>
          <tbody>{$hint}</tbody>";
      }
    }
  }
}

 





//  
//   public function addUser()
//   {
//     if (isset($_POST["username"]) && !empty($_POST["password"])) {
//       $username = $this->usermanager->find($_POST["username"]);
//       if ($username['username'] === $_POST["username"]) {
//         $this->usermanager->add($_POST["email"], $_POST["username"], $_POST["password"]);
//         header('Location: ../views/home.php');
//       } else return  "<br>this username exist try another";
//     }
//   }
//   /*
//       user exist
//       */
//   public function user_exist($pdo)
//   {
//     if (isset($_POST["username"])) {
//       $this->username = $_POST["username"];
//       $insertRow = "SELECT username FROM User WHERE username=:username";

//       $result = $pdo->prepare($insertRow);
//       $result->execute(array("username" => $this->username));
//       $row = $result->fetch(); // return bool
//     }
//     if ($row === false) {
//       return true; // not exist you can add it
//     } else  return false;
//   }
// }
