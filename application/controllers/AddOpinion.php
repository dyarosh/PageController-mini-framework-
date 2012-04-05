<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitriy
 * Date: 05.04.12
 * Time: 23:46
 * To change this template use File | Settings | File Templates.
 */
namespace application\controllers;
Class AddOpinion extends \library\PageController
{
    function process()
    {
        try {
            $request = $this->getRequest();
            $title = $request->getProperty('title');
            $type = $request->getProperty('type');
            $author = $request->getProperty('author');
            $email = $request->getProperty('email');
            $text = $request->getProperty('text');
            //$opinion = new \domain\Opinion(null, $title, $type, $author, $email, $text);
            //$this->forward('ListOpinion.php');
        } catch (\Exception $e) {
            echo $e;
        }
    }
}