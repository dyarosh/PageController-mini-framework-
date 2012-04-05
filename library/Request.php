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
 * Класс запроса
 *
 * @uses \library\RequestRegistry
 * @category utr.ua
 * @package library
 */
class Request {
    private $properties = array();
    private $feedback = array();

    function __construct(){
        $this->init();
        RequestRegistry::setRequest($this);
    }

    function init(){
        if(isset($_SERVER['REQUEST_METHOD'])){
            $this->properties = $_REQUEST;
            return;
        }
        foreach($_SERVER['argv'] as $arg){
            if(str_pos($arg, '=')){
                list($key,$val) = explode('=', $arg);
                $this->setProperty($key,$val);
            }
        }
    }

    function getProperty($key){
        if(isset($this->properties[$key])){
            return $this->properties[$key];
        }
    }

    function setProperty($key, $value){
        $this->properties[$key] = $value;
    }

    function addFeedback($msg){
        array_push($this->feedback,$msg);
    }

    function getFeedback() {
        return $this->feedback;
    }

    function getFeedbackString($separator = "\n") {
        return implode($separator, $this->feedback);
    }

    function getLastCommand() {
        if(isset($this->properties['last_cmd'])){
            return $this->properties['last_cmd'];
        }
        return false;
    }

    function setCommand($value){
        $this->properties['last_cmd'] = $value;
    }

}
