<?php
/**
 * Created by JetBrains PhpStorm.
 * User: yaroshevich
 * Date: 24.01.12
 * Time: 16:29
 * To change this template use File | Settings | File Templates.
 */
namespace library;
header('Content-type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../library/Core.php';
$app = Core::getInstance();
$app->start();