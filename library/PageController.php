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
 * Базовый класс паттерна PageController
 *
 * @uses \library\RequestRegistry
 * @uses \library\Request
 * @category utr.ua
 * @package library
 */
abstract class PageController
{
    private $request;


    function __construct()
    {
        $request = RequestRegistry::getRequest();
        if(is_null($request)) {
            $request = new Request();
        }
        $this->request = $request;
    }

    abstract function process();

    function forward($resource)
    {
        include('../application/views/' . $resource);
        exit(0);
    }

    function getRequest()
    {
        return $this->request;
    }
}
