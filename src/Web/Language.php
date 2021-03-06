<?php
namespace Seals\Web;

class Language {
    public static $lang = "th";
    public static $arrLang;

    /**
     * register
     * 
     * @param {string} $path
     * @param {string} @lang
     */
    public static function register ($path,$lang) {
        self::$lang = $lang;
        $files = preg_grep('/\.php$/', scandir($path));

        
        foreach ($files as $file  => $value) {                            
            $name = basename($value);
            self::$arrLang[$name] = require_once($path . DIRECTORY_SEPARATOR . $value);
        }
    }

    /**
     * init
     * 
     * @param {string} $path
     * @param {string} @lang
     */
    public static function get ($key,$lang="") {
        $arrKey = explode(".",$key);

        if (count($arrKey)==2) {
            if (isset(self::$arrLang[$arrKey[0]][$arrKey[1]])) {
                return self::$arrLang[$arrKey[0]][$arrKey[1]];
            }
            return '';
        } else {
            return '';
        }        

    }

    /**
     * getLang
     *      
     * @param {string} @lang
     */
    public static function getLang () {
        return self::$lang;
    }

    /**
     * setLang
     *      
     * @param {string} @lang
     */
    public static function setLang ($lang) {        
        self::$lange = $lang;
    }
}

?>