<?php 
// define view directory
define('DIR_VIEW', '../pages/');

// check which page we are requesting
$page = isset($_GET['page']) ? $_GET['page'] : 'HomeController';

// now send output
include($page. '.php');