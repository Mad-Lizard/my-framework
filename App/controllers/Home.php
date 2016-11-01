<?php
namespace App\controllers;

use core\Controller;
use core\View;

class Home extends Controller{
    
   /* protected function before() {
        echo "(before) ";
        
    }
    
    protected function after() {
        echo " (after)";
    } */
    
    public function indexAction() {
        //echo 'Привет из индекс-метода контроллера Дом!';
       View::render('Home/index.php', [
            'name' => 'Анна', 'colours' => ['красный', 'синий', 'зелёный']
            ]); 
        
    /*  View::renderTemplate('Home/index.html', [
            'name' => 'Анна', 'colours' => ['красный', 'синий', 'зелёный']
            ]); */
    }
}
