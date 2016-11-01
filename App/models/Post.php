<?php
namespace App\models;
use core\Model;

use PDO;

class Post extends Model{
    
    public static function getAll(){
        
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT id, title, content FROM posts ORDER BY created_at');
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              
                 return $result;
        } catch (PDOException $ex) {
                echo $e->getMessage();
        }
    }
}