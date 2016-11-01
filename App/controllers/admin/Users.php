<?php
namespace App\controllers\admin;

use core\Controller;

class Users extends Controller {
    
    protected function before(){
        
    }
    
    public function indexAction() {
        echo 'Индекс пользователя-администратора';
    }
}