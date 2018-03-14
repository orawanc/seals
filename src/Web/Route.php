<?php
namespace Seals\Web;

use AltoRouter;

class Route {     
    
    /**
     * load
     * 
     * @param {string} $path
     */
    public static function load($path) {
        foreach (scandir($path) as $file) {
            if (is_dir($file)) {
                self::load($file);
            } else {
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                if ($ext==".php") {
                    require_once($path . DIRECTORY_SEPARATOR . $file);
                }
            }
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
        $router = new AltoRouter();
        $router->map($method,$route,$target,$name);
    
        
        $match = $router->match();
        
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

}

?>