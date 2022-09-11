<?php

namespace App\Controllers;

use App\Managers\CategoryManager;

class CategoryController
{

  private $Categorymanager;
  public function __construct()
  {
    $this->Categorymanager = new CategoryManager();
  }
  public function addCategory()
  {
    if (isset($_POST["category"]) && !empty($_POST["category"])) {
      $category = $this->Categorymanager->find($_POST["category"]);
      if ($category == false) {
        $this->Categorymanager->add($_POST["category"]);
        echo 'category  added';
      }else echo  "<br>this category exist try another";
    }else echo 'verify fields';
  }

  public function updateCategory()
  {
    if (isset($_POST["category"]) && !empty($_POST["id"])) {
      $id = $this->Categorymanager->find($_POST["id"]);
      //dump($id);die();
      if ($id == true) {
        $this->Categorymanager->update($_POST["id"],$_POST["category"]);
        echo 'Category  updated';
      }else echo  "<br>this id don t exist try another";
    }else echo 'verify fields';
  }

  public function deleteCategory()
  {
    if (isset($_POST["category"])) {
      $category = $this->Categorymanager->find($_POST["category"]);
      if (is_array($category)) {
        $this->Categorymanager->delete($_POST["category"]);
        echo 'category  deleted';
      }else echo  "<br>this category don t exist try another";
    }else echo 'verify fields';
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
