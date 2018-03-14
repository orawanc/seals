<?php
namespace Seals\Web;

use AltoRouter;

class Route {     
    
    public static $router = "";

    /**
     * load
     * 
     * @param {string} $path
     */
    public static function load($path) {        
        self::$router = new AltoRouter();

        $files = preg_grep('/\.php$/', scandir($path));

        
        foreach ($files as $file  => $value) {                                    
            require_once($path . DIRECTORY_SEPARATOR . $value);
        }

        $match = self::$router->match();
        
        if($match){
            list($controller, $controllermethod) = explode('@', $match['target']);            
            
            if(is_callable(array(new $controller, $controllermethod))){
                call_user_func_array(array(new $controller, $controllermethod),
                    array($match['params']));
            }else{
                echo "The method {$controllermethod} is not defined in {$controller}";
            }
        }else{
            header($_SERVER['SERVER_PROTOCOL'].'404 Not Found');
            View::render('errors/404');
        }
    }
    
    /**
     * map
     * 
     * @param {string} method
     * @param {string} route
     * @param {string} target
     * @param {string} name
     */
    public static function map($method,$route,$target,$name) {                
        self::$router->map($method,$route,$target,$name);
    }    
}

?>