<?php
/**
 * Статистика сервиса онлайн-заказов
 * @category utr.ua
 * @author Ярошевич Д.А. <yaroshevich@utr.ua>
 * @copyright "ЮникТрейд" 1994-2012
 */

/**
 * @namespace
 */
namespace library;
/**
 * Загрузчик классов.
 *
 * @uses \library\AppException
 * @category utr.ua
 * @package library
 */
class Loader {
    private $_debug = array();

    public function __construct() {
        spl_autoload_register(array($this, 'autoLoad'));
    }

    public function autoLoad($class)
    {
        $file = dirname(__FILE__).'/../'.str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
        if (file_exists ($file)) {
            $this->_debug[] = "Class $class is successful loaded.";
            require_once $file;
        } else {
            $this->_debug[] = "Class $class is not loaded.";
            throw new AppException ("Class $class is not loaded.");
        }
    }

    public function debug_info(){
        print_r($this->_debug);
    }
}
