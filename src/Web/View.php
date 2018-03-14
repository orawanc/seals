<?php

namespace Seals\Web;

use Philo\Blade\Blade;

class View
{

    public static $viewsPath="";
    public static $cachePath="";

    /**
     * setBaePath
     * 
     * @param $views
     * @param $cache
     */
    public static function setBasePath($views,$cache) {
        self::$viewsPath = $views;
        self::$cachePath = $cache;                
    }

    /**
     * views
     * 
     * @param $path
     * @param $data
     * @return mixed
     */
    public static function render($path, array $data = []) {        
        
        $blade = new Blade(self::$viewsPath,self::$cachePath);
            
        echo $blade->view()->make($path,$data)->render();
    }        
}

?>