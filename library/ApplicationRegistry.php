<?php
/**
 * Статистика сервиса онлайн-заказов
 * @author Ярошевич Д.А. <yaroshevich@utr.ua>
 * @copyright "ЮникТрейд" 1994-2012
 * @package reports_utr
 * @version 1.0
 */

/**
 * @namespace
 */
namespace library;
/**
 * Реестр приложения.
 *
 * @uses \library\Registry
 * @category utr.ua
 * @package reports_utr
 *
 */
class ApplicationRegistry extends Registry {

    private static $instance;
    private $freezedir = '/tmp';
    private $values = array();
    private $mtimes = array();

    private function __construct() {}

    static function instance() {
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function get($key){
        $path = $this->freezedir.DIRECTORY_SEPARATOR.$key;
        if(file_exists($path)){
            clearstatcache();
            $mtime = filemtime($path);
            if(!isset($this->mtimes[$key])) $this->mtimes[$key] = 0;
            if($mtime > $this->mtimes[$key]){
                $data = file_get_contents($path);
                $this->mtimes[$key] = $mtime;
                return $this->values[$key] = unserialize($data);
            }
        }
        if(isset($this->values[$key])) return $this->values[$key];
        return null;
    }

    protected function set($key, $val){
        $this->values[$key] = $val;
        $path = $this->freezedir.DIRECTORY_SEPARATOR.$key;
        file_put_contents($path, serialize($val));
        $this->mtimes[$key] = time();
    }

    static function getconfig() {
        return self::instance()->get('config');
    }

    static function setconfig($config) {
        return self::instance()->set('config', $config);
    }
}
