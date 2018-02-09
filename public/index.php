<?php 
// define view directory
define('DIR_VIEW', '../pages/');
// define controllers directory
define('DIR_CONTROLLERS', '../app/controllers/');

// check which page we are requesting
$page = isset($_GET['page']) ? $_GET['page'] : 'HomeController';

// capture action params
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// now send output
include(DIR_CONTROLLERS . $page. '.php');
// classify
$controller = new $page;
// $controller->index();
$controller->{$action}();