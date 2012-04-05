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
 * Парсинг и загрузка конфигурационного ini файла.
 *
 * @uses \library\AppException
 * @category utr.ua
 * @package library
 */
class Conf {
    private $file;
    private $options;

    function __construct($file)
    {
        $this->file = $file;
        if(!file_exists($file)){
            throw new AppException("Файл '$file' не найден");
        }
        $this->options = parse_ini_file($file, true);
    }

    public function getOptions()
    {
        return $this->options;
    }
}
