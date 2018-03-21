<?php
namespace Seals\Web;

use AltoRouter;

class Route {     
    
    public static $router = "";

    /**
     * register web router
     * 
     * @param {string} $webpath
     * @param {string} $apipath
     */
    public static function register($webpath,$apipath) {        
        self::$router = new AltoRouter();

        self::load($webpath);
        self::load($apipath);
        
    }

    private static function load ($path) {
        $files = preg_grep('/\.php$/', scandir($path));

        
        if (count($files)>0) {
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