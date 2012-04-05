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
 * Базовый класс реестра Registry
 *
 * @category utr.ua
 * @package library
 */
abstract class Registry {
    abstract protected function get($key);
    abstract protected function set($key, $val);
}
