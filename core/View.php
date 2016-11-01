<?php

namespace core;

class View {
    
    public static function render($view, $args = []){
        
        extract($args, EXTR_SKIP);
        $file = "..\\App\\views\\$view";
        
        if(is_readable($file)){
            require $file;
        } else {
            //echo "$file не найден.";
            throw new \Exception("$file не найден.");
        }
    } 
    
    public static function renderTemplate($template, $args = []){
        static $twig = null;

        if($twig === null){
            $loader = new \Twig_Loader_Filesystem('../App/views');
            $twig = new \Twig_Environment($loader);

        }
 
        echo $twig->render($template, $args);
    }
}