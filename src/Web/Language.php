<?php
namespace Seals\Web\Language;

class Language {
    public static $lang;
    public static $arrLang;

    /**
     * init
     * 
     * @param {string} $path
     * @param {string} @lang
     */
    public static function init ($path,$lang) {
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
        $selectLang = ($lang=="")?self::$lang:$lang;

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