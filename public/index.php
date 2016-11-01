<?php 
require_once (dirname(__DIR__) . '\\vendor\\twig\\lib\\Twig\\Autoloader.php');
Twig_Autoloader::register();


//Autoloader
spl_autoload_register(function ($class){
    $root = dirname(__DIR__);
    $file = $root . '\\' . $class . '.php';
    if(is_readable($file)){
        require $file;
    }
});

error_reporting(E_ALL);
set_error_handler('core\Error::errorHandler');
set_exception_handler('core\Error::exeptionHandler');

$router = new core\Router();


//add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
//$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'admin']);
$router->add('{controller}/{id:\d+}/{action}');



//display the routing table
/*echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>'; */


//Match the requested route  
/*$url = $_SERVER['QUERY_STRING'];
 
if ($router->match($url)){
    echo '<pre>';
 //   var_dump($router->getRoutes());
    echo htmlspecialchars(print_r($router->getRoutes(), true));
    echo '</pre>';
} else {
    echo "Маршрут для URL '$url' не найден.";
} 

echo '<pre>';
var_dump($router->getParams());
var_dump($_GET);
echo '</pre>';
*/
$router->dispatch($_SERVER['QUERY_STRING']);


