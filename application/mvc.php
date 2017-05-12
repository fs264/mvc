<?php

require 'view/load.php';
require 'model/model.php';
require 'controller/controller.php';

$pageURI = $_SERVER['REQUEST_URI'];
$pageURI = substr($pageURI,strrpos($pageURI, 'index.php')+10);

$get_value = null;

if(strrpos($pageURI, '?')){
	$get_value = substr($pageURI,strrpos($pageURI, '?')+1);
	$pageURI = substr($pageURI, 0, strrpos($pageURI, '?'));

} 

if(!$pageURI)
	new Controller('home');
else
	new Controller($pageURI, $get_value);
?>