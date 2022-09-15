<?php
use App\Services\Router;
require "../vendor/autoload.php";
$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
//-----------------debug time
define('DEBUG', microtime(true));
// --------------------
$router = new Router();
//$router->getMap('/blog/[*:post]-[i:id]', 'blog/showPost', 'post');
// /---------------------
$router->getMap('/', 'home', 'home');
$router->getMap('/contact', 'contact', 'contact');
// ------------------------
$router->getMap('/blog', 'blog/index', 'blog');
$router->getMap('/blog/[i:id]','blog/detailpage', 'detailblog');
// --------------------------
$router->getMap('/user/loginpage', 'user/loginpage', 'userlogin');
$router->getMap('/user/login', 'AuthController@getSession', 'loginUser');
$router->getMap('/user/logout', 'AuthController@logout', 'logoutUser');
// -----------------------------
$router->getMap('/user/showpage', 'user/showpage', 'usershow');
$router->getMap('/user/addpage', 'user/addpage', 'useradd');
$router->getMap('/user/updatepage/[i:id]', 'user/updatepage', 'userupdate');
$router->getMap('/user/delete-page/[i:id]', 'user/deletepage', 'userdelete');

$router->getMap('/user/add', 'UserController@addUser', 'addUser');
$router->getMap('/user/update', 'UserController@updateUser', 'updateUser');
$router->getMap('/user/delete', 'UserController@deleteUser', 'deleteUser');
// -----------------
$router->getMap('/category/showpage', 'category/showpage', 'categoryshow');
$router->getMap('/category/addpage', 'category/addpage', 'categoryadd');
$router->getMap('/category/updatepage/[i:id]', 'category/updatepage', 'categoryupdate');
$router->getMap('/category/delete-page/[i:id]', 'category/deletepage', 'categorydelete');

$router->getMap('/category/add', 'CategoryController@addcategory', 'addcategory');
$router->getMap('/category/update', 'CategoryController@updatecategory', 'updatecategory');
$router->getMap('/category/delete', 'CategoryController@deletecategory', 'deletecategory');
// ------------------
$router->getMap('/post/showpage', 'post/showpage', 'postshow');
$router->getMap('/post/addpage', 'post/addpage', 'postadd');
$router->getMap('/post/updatepage/[i:id]', 'post/updatepage', 'postupdate');
$router->getMap('/post/delete-page/[i:id]', 'post/deletepage', 'postdelete');

$router->getMap('/post/add', 'PostController@addPost', 'addpost');
$router->getMap('/post/update', 'PostController@updatePost', 'updatepost');
$router->getMap('/post/delete', 'PostController@deletePost', 'deletepost');
// --------------
$router->getMap('/comment/post/[i:id]', 'comment/index', 'commentpost');
$router->getMap('/comment/addpage', 'comment/addpage', 'commentadd');
$router->getMap('/comment/updatepage/[i:id]', 'comment/updatepage', 'commentupdate');
$router->getMap('/comment/delete-page/[i:id]', 'comment/deletepage', 'commentdelete');

$router->getMap('/comment/add', 'CommentController@addComment', 'addcomment');
$router->getMap('/comment/update', 'CommentController@updatecomment', 'updatecomment');
$router->getMap('/comment/delete', 'CommentController@deletecomment', 'deletecomment');
// --------views-
require '../views/parts/header.php';;
$match = $router->run(dirname(__DIR__) . '\views');
require '../views/parts/footer.php';
// ------------ see later 





// dump($router->get_map('GET', '/blog', 'post/index', 'blog'));

// $uri = $_SERVER['REQUEST_URI'];
// $router = new AltoRouter();

// $router->map('GET', '/', 'home');
// $router->map('GET', '/contact', 'contact', 'contact');
// $router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');
// // $router->map('method', 'path'=path to write in url+params rec in match['target'], 'template to load'=target, 'name in objet target');
// $match = $router->match();

// //require '../elements/header.php';

// if (is_array($match)) {
//     $params = $match['params'];
//     //dump($match);
//     require "../templates/{$match['target']}.php";
// } else {
//     require "../templates/404.php";
// }

// //require '../elements/footer.php';

// //require '../vendor/autoload.php';
// // $router->map('GET', '/contact', 'contact', 'contact');
// // $router->map('method', 'path'=path to write in url, 'template to load'=target, 'nom de la route'=);
// //$uri = $_SERVER['REQUEST_URI'];
// //var_dump($uri,$_GET);
// // $router = new AltoRouter();
// // $router->map('GET', '/contact', function(){echo "contact";});
// $router->map('GET', '/blog/[*:slug]-[*:msg]-[i:id]', function($slug,$msg,$id){echo "match blog";});
// $match = $router->match();
// dump($match);
// if($match!==null){
    //$match['target']($match['params']['slug'],$match['params']['msg'],$match['params']['id']);
    // $match['target']();
// }

//require '../elements/footer.php';