<?php
namespace core;

class Router {
    //routing table
    protected $routes = [];
    
    protected $params = [];
    //filling routing table
    //$route - from URL - string
    //$params - controllers, actions, etc. - array
    public function add($route, $params = []) {
        
        //Convert the route to regular expression: escape slashes
        $route = preg_replace('/\//', '\\/', $route);
        
        //Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        
        //Convert variables with custom regular expression e.g. id
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route); 
         
        //Add start and end delimiters, and case insensetivw flag
        $route = '/^' . $route . '$/i';
        
        $this->routes[$route] = $params;
    }
    
    //get whole table
    public function getRoutes() {
        return $this->routes;
    }
    
    //match the route to the routing table, setting $params if it matchs
    //$url - string
    public function match($url){
       /* foreach ($this->routes as $route => $params){
            if($url == $route){
                $this->params = $params;
                return true;
            }   
        } */
        /*
        $controller = $this->params['controller'];
        $controller = $this->convertToStudlyCaps($controller);
        $controller = "App\controllers\\$controller";
        
        if(class_exists($controller)){
            $controller_object = new $controller($this->params);
            
            $action = $this->params['action'];
            $action = $this->convertToCamelCase($action);
            
            if(method_exists($controller_object, $action)){
                $controller_object->$action();
            } else {
                echo "Класс контроллера $controller не найден."; 
            }
            } else {
                echo 'Нет соответствующего маршрута.';    
            }
        } */
        $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
        foreach ($this->routes as $route=>$params){
        if (preg_match($route, $url, $matches)){
           // $params = [];
            
            foreach ($matches as $key => $match){
                if (is_string($key)){
                    $params[$key] = $match;
                }
            }
        
            $this->params = $params;
            return true;
        } 
     }  
        return false;
    }
    
    //get the matched parameters
    public function getParams() {
        return $this->params;
    } 
    
    public function dispatch($url) {
        
        $url = $this->removeQueryStringVariables($url);
        
        if($this->match($url)){
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
        //    $controller = "App\controllers\\$controller";
            $controller = $this->getNamespace() . $controller;
            
            if(class_exists($controller)){
                $controller_object = new $controller($this->params);
                
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);
               // $action = $action . 'Action';
                                
              //  if(method_exists($controller_object, $action)){
                    $controller_object->$action();
                    
             //   } else {
             //       echo "Метод $action (в контроллере $controller) не найден!";
                 
            }  else {
                //echo "Класс контроллера $controller не найден.";
                throw new \Exception("Класс контроллера $controller не найден.");
            } 
        } else {
            //echo "Нет соответствующего маршрута.";
            throw new \Exception("Нет соответствующего маршрута.", 404);
        }
    }
    
    protected function convertToStudlyCaps($string){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }
    
    protected function convertToCamelCase($string) {
        return lcfirst($this->convertToStudlyCaps($string));
    }
    
    protected function removeQueryStringVariables($url) {
        if($url != ''){
            $parts = explode('&', $url, 2);
                    $parts = explode('?', $url, 2);
            
            if (strpos($parts[0], '=')=== false){
                $url = $parts[0];
            } else {
            $url = '';
            }
        }
        return $url;
    }
    
    protected function getNamespace() {
        $namespace = 'App\controllers\\';
        
        if(array_key_exists('namespace', $this->params)){
        $namespace .= $this->params['namespace'] . '\\';
        }
        return $namespace;
    }
}
?>
