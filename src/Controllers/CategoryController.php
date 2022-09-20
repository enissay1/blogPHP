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
      } else echo  "<br>this category exist try another";
    } else echo 'verify fields';
  }

  public function updateCategory()
  {
    if (isset($_POST["category"]) && !empty($_POST["id"])) {
      $id = $this->Categorymanager->find($_POST["id"]);
      //dump($id);die();
      if ($id == true) {
        $this->Categorymanager->update($_POST["id"], $_POST["category"]);
        echo 'Category  updated';
      } else echo  "<br>this id don t exist try another";
    } else echo 'verify fields';
  }

  public function deleteCategory()
  {
    if (isset($_POST["category"])) {
      $category = $this->Categorymanager->find($_POST["category"]);
      if (is_array($category)) {
        $this->Categorymanager->delete($_POST["category"]);
        echo 'category  deleted';
      } else echo  "<br>this category don t exist try another";
    } else echo 'verify fields';
  }

  public function searchCategory()
  {


    $results = $this->Categorymanager->findAll();
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
          if (stristr($q, substr($name['name'], 0, $len))) {
            if ($hint === "") {
              $hint = "
              <tr>
              <td scope='row'>{$name['id']}</td>
              <td scope='row'>{$name['name']}</td>
              </tr>";
            } else {
              $hint .=  "
              <tr>
              <td scope='row'>{$name['id']}</td>
              <td scope='row'>{$name['name']}</td>
              </tr>";
            }
          }
          
        }
        // Output "no suggestion" if no hint was found or output correct values
          //echo $hint === "" ? "no suggestion" : $hint;
        echo "
        <thead>
          <tr>
              <th scope='col'>ID</th>
              <th scope='col'>Category</th>
          </tr>
      </thead>
          <tbody>{$hint}</tbody>";
      }
    }
  }
}
 
// <!-- <table class="table table-striped table-bordered">
//     <thead>
//         <tr>
//             <th scope="col">ID</th>
//             <th scope="col">Category</th>
//             <th scope="col" class="text-center">Manager</th>
//         </tr>
//     </thead>
//   




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
