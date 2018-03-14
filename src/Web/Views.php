<?
namespace Seals\Web;

use Philo\Blade\Blade;

class Views 
{
    /**
     * views
     * 
     * @param $path
     * @param $data
     * @return mixed
     */
    public static function render($path, array $data = []) {        
        $views = __DIR__ . '../../../resources/views';
        $cache = __DIR__ . '../../../bootstrap/cache';
    
        $blade = new Blade($view,$cache);
    
        echo $blade->views()->make($path,$data)->render();
    }        
}

?>