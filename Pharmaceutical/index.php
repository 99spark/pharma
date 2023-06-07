<?php

// This is the controller

//Turn on output buffering
ob_start();

//Turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

// Project for SDEV 334 agile

//Require the autoload file
require_once ('vendor/autoload.php');

session_start();

$f3 =Base::instance();

$con = new Controller($f3);
$dataLayer = new Datalayer();

// Temporary test code to add drugs
//$drug1 = new Drug('90375',10,'srt-dsc','code dosage',6.13,'vac%','vac-lim','blood%','blood-limit','clott-fact','saveDrug() working');
//echo var_dump($twoDrugPrices);
//$dataLayer->saveDrug($drug1);






/*
 *************************
 * Define a default route
 * ***********************
 */
$f3->route('GET|POST /', function($f3, $params) {
    global $con;
    $con->home();
});

//define register route
$f3->route('GET|POST /userLogin', function($f3, $params) {
    global $con;
    $con->login();
});
$f3->route('GET|POST /passwordupdate', function($f3, $params) {
    global $con;
    $con->passwordupdate();
});

//define 
$f3->route('GET|POST /user', function($f3, $params) {
    global $con;
    $con->user();
});


//define register route
$f3->route('GET|POST /register', function($f3, $params) {
    global $con;
    $con->register();
});

//define admin route
$f3->route('GET|POST /admin',function($f3,$params){
    global $con;
    $con->admin();
});

$f3->route('GET|POST /adminLogin',function($f3,$params){
    global $con;
    $con->adminLogin();
});

$f3->route('GET /adminLogout',function($f3,$params){
    global $con;
    $con->adminLogout();
});

$f3->route('GET /logout',function($f3,$params){
    global $con;
    $con->logout();
});

$f3->route('GET /confirm',function($f3,$params){
    global $con;
    $con->confirm();
});

//Run fat-free
$f3->run();

//Send output to the broweser
ob_flush();