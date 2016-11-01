<?php
namespace core;


class Error {
    
    public static function errorHandler($level, $message, $file, $line){
        if(error_reporting()!==0){
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }
    
    public static function exeptionHandler($exeption){
        
        $code = $exeption->getCode();
        if($code != 404){
            $code = 500;
        }
        http_response_code($code);
        
        if(\App\Config::SHOW_ERRORS){
        echo "<h1>Фатальная ошибка</h1>";
        echo "<p>Исключение: '" . get_class($exeption) . "'</p>";
        echo "<p>Сообщение: '" . $exeption->getMessage() . "'</p>";
        echo "<p>Трасса стека:<pre>" . $exeption->getTraceAsString() . "</pre></p>";
        echo "<p>Возникло в '" . $exeption->getFile() . "' на строке " . $exeption->getLine() . "</p>" ;
    } else {
        $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . 'txt';
        ini_set('error_log', $log);
        
        $message = "Выявленно исключение: '" . get_class($exeption) . "'";
        $message .= " с сообщением '" . $exeption->getMessage() . "'";
        $message .= "\nТрасса стека:" . $exeption->getTraceAsString();
        $message .= "\nвозникло в '" . $exeption->getFile() . "' на строке " . $exeption->getLine();
        
        error_log($message);
        //echo "<h1>Возникла ошибка</h1>";
       /* if($code == 404){
            echo "<h1>Страница не найдена</h1>";
        } else {
            echo "<h1>Возникла ошибка</h1>";
        }*/
        View::render("$code.php");  
    }
  }
}
