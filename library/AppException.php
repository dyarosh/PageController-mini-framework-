<?php
/**
 * Статистика сервиса онлайн-заказов
 *
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
 * Обработка исключений приложения
 *
 * @uses \Exception
 * @package reports_utr
 *
 */
class AppException extends \Exception {

  /**
     * @var string Текст сообщения.
     */
    private $error;

  /**
     * @param string $message Сообщение об ошибке
     */
    function __construct($message) {
        $this->error = $message;
        parent::__construct($message);
    }

  /**
     * @return string Сообщение об ошибке.
     */
    function getErrorMessage(){
        return $this->error;
    }
}
