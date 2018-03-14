<?php
namespace Seals\Web;

use AltoRouter;

class Route {        
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
            views('errors/404');
        }
    }

}

?>