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
 * Базовый класс паттерна Transaction Script
 *
 * @uses \library\AppException
 * @uses \library\ApplicationRegistry
 * @uses \PDO
 * @category utr.ua
 * @package library
 */
abstract class Base
{
    static $DB;
    static $stmts = array();

    function __construct(){
        $config = ApplicationRegistry::getconfig();
        $dsn = $config['db']['db'].':dbname='.$config['db']['db.database'].';host='.$config['db']['db.host'];
        if(is_null($dsn)) {
            throw new AppException("DSN не задан.");
        }
        self::$DB = new \PDO($dsn, $config['db']['db.user'], $config['db']['db.password']);
        self::$DB->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    function prepareStatement($stmt_s) {
        if(isset(self::$stmts[$stmt_s])) {
            return self::$stmts[$stmt_s];
        }
        $stmt_handle = self::$DB->prepare($stmt_s);
        self::$stmts[$stmt_s] = $stmt_handle;
        return $stmt_handle;
    }

    protected function doStatement($stmt_s, $values_a) {
        $sth = $this->prepareStatement($stmt_s);
        $sth->closeCursor();
        $db_result = $sth->execute($values_a);
        return $sth;
    }
}
