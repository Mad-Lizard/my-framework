<?php

namespace core;

abstract class Controller {
    
    //parameters from the matched route
    protected $route_params = [];
   
    
    public function __construct($route_params) {
        $this->route_params = $route_params;
    }
    
    public function __call($name, $args) {
        $method = $name . 'Action';
               
        if(method_exists($this, $method)){
            if($this->before()!== false){
            call_user_func_array(array($this, $method), $args);
            $this->after();
            }
        } else {
            // echo "Метод $method не найден " . "(в контроллере " . get_class($this) . ")" ;
            throw new \Exeption("Метод $method не найден " . "(в контроллере " . get_class($this) . ")");
        }
    }
    
    protected function before() {
        
    }
    
    protected function after() {
        
    }
}
