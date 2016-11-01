<?php
namespace App\controllers;

use core\Controller;
use App\models\Post;
use core\View;

class Posts extends Controller{
    
    public function indexAction() {
        //echo 'Привет из индекс-метода контроллера Посты!';
        //echo '<p>Параметры запроса: <pre>' . htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
        $posts = Post::getAll();
        View::render('Posts/index.php', [
            'posts' => $posts
        ]);
    }
    
    public function addNewAction() {
        echo 'Привет из метода-добавлялки контроллера Посты!';
    }
    
    public function editAction() {
        echo 'Привет из редактор-метода контроллера Посты!';
        echo '<p>Параметры маршрута: <pre>' . htmlspecialchars(print_r($this->route_params, true)) . '</p></pre>';
    }
}
