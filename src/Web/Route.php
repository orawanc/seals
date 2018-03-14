<?php
namespace Seals\Web;

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
        new RouteDispatcher($router);
    }

}

?>