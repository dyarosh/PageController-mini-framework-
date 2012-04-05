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
 * Шаблонизатор
 *
 * @uses \library\Registry
 * @uses \library\AppException
 * @author Герасимов Константин
 * @link http://itdumka.com.ua/
 * @category utr.ua
 * @package library
 */
class Template
{
    /**
        * @var array
        */
    private $_Vars;
    /**
         * @var string
         */
    private $_Name;
    /**
         * @var string
         */
    private $_Path;

    public function __construct() {
        $this->_Name = '';
        $this->_Vars = array();
        $this->_Path = '';
    }

    /**
        * @param string $VarName имя переменной
        * @param string $VarValue значение переменной
        * @return Template
        */
    public function addVar($VarName,$VarValue)
    {
        if($VarName !== '') {
            $this->_Vars[$VarName] = $VarValue;
        }
        return $this;
    }

    /**
        * @param string $VarName имя переменной
        * @return mixed
        */
    public function __get($VarName)
    {
        if(array_key_exists($VarName, $this->_Vars)) {
            if($this->_Vars[$VarName] instanceof Template) {
                return $this->_Vars[$VarName]->prepare();
            } else {
                return $this->_Vars[$VarName];
            }
        }
        return null;
    }

    /**
        * @param string $Name имя файла шаблона
        */
    public function setName($Name)
    {
        $this->_Name = $Name;
    }

    /**
        * @param string $Path путь к шаблонам
        */
    public function setPath($Path)
    {
        $this->_Path = $Path;
    }

    /**
        * @param string $Var
        * @return string
        */
    protected function EscapeHtml($Var)
    {
        if(is_array($Var)) {
            foreach($Var as &$VarItem) {
                $VarItem = $this->EscapeHtml($VarItem);
            }
        } else {
            $Var = htmlspecialchars($Var, ENT_QUOTES);
        }
        return $Var;
    }

    /**
        * @param string $Var
        * @return string
        */
    protected function EscapeUrl($Var)
    {
        if(is_array($Var)) {
            foreach($Var as &$VarItem) {
                $VarItem = $this->EscapeUrl($VarItem);
            }
        } else {
            $Var = htmlentities($Var, ENT_QUOTES);
        }
        return $Var;
    }
    /**
        * Свойство хранящее текущий режим
        * @static
        * @var bool
        */
    private static $_Debug = false;

    /**
        * Вкл/Выкл. дебаг режим
        * @static
        * @param bool $TrueOrFalse TRUE
        */
    public static function setDebug($TrueOrFalse = true) {
        self::$_Debug = $TrueOrFalse;
    }

    /**
     * Возвращает $text с удаленными "\t", "\n", "\r"
     * @param string $Text
     * @return string
     */
    private function _Zip($Text)
    {
        return (empty($Text)) ? $Text : str_replace(array("\t", "\n", "\r"), '', $Text);
    }

    /**
        * @return string
        * @throws Exception
        */
    public function Prepare()
    {
        if (file_exists($this->_Path . $this->_Name)) {
            ob_start();
            ${__CLASS__} = $this;
            include $this->_Path . $this->_Name;
            unset(${__CLASS__});
            return (self::$_Debug) ? ob_get_clean() : $this->_Zip(ob_get_clean());
        } else {
            throw new AppException('Template file "' . $this->_Path . $this->_Name . '" does not exists');
        }
    }

    public function Display()
    {
        print ($this->Prepare());
    }
}
