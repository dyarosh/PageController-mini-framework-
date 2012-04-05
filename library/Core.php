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
 * Ядро системы.
 *
 * @uses \library\Loader
 * @uses \library\Conf
 * @uses \library\ApplicationRegistry
 * @uses \library\RequestRegistry
 * @uses \library\Request
 * @uses \library\ReportsView
 * @uses \library\Template
 * @uses \reports\MainMenu
 * @category utr.ua
 * @package library
 */
class Core
{
    private $_loader;
    private static $instance;

    private function __construct() {}

    static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new Core();
        }
        return self::$instance;
    }

    function start() {
        require_once('Loader.php');
        $this->_loader = new Loader();

        $config = new Conf(__DIR__.'/../application/configs/config.ini');
        ApplicationRegistry::setconfig($config->getOptions());

        $request = RequestRegistry::getRequest();
        if(is_null($request)) {
            $request = new Request();
        }
        $command = $request->getProperty('command');
        if(empty($report)) $command = 'AddOpinion';
        $path_to_command = '../application/controllers/'.$command;

        $command_class_name = '\\application\\controllers\\'.$command;

        $controller = new $command_class_name;

        $command_view = new CommandView($command);
        //$command_view->assign($controller->process());

        $this->view($command_view);
    }

    private function view($command_view) {
        Template::setDebug(true);
        $template = new Template();
        $template->setPath('../application/template/');

        $config = ApplicationRegistry::getconfig();
        $template->setName($config['main']['template']);

        $template->addVar('title',$config['main']['title']);
        $template->addVar('main', $command_view);

        $template->Display();

    }
}
