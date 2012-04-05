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
 * Реестр запроса
 *
 * @uses \library\Registry
 * @uses \library\AppException
 * @category utr.ua
 * @package library
 */
class RequestRegistry extends Registry {
    private static $instance;
    private $values = array();

    private function __construct() {}

    static function instance() {
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function get($key){
        if(isset($this->values[$key])) return $this->values[$key];
    }

    protected function set($key, $val){
        $this->values[$key] = $val;
    }

    static function getRequest() {
        return self::instance()->get('request');
    }

    static function setRequest(Request $request) {
        return self::instance()->set('request', $request);
    }

    static function setReport(array $report){
        return self::instance()->set('report', $report);
    }

    static function getReport($param = null){
        $report = self::instance()->get('report');
        if($param!=null) {
            if(isset($report[$param])) {
                return $report[$param];
            } else {
                throw new AppException("Не найден параметр '$param'!");
            }
        }
        return $report;
    }
}
