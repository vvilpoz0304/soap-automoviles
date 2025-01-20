<?php
/*
 * Servicio Web en PHP por Jose Hernández
 * https://josehernandez.es/2011/01/18/servicio-web-php.html
 * https://web.archive.org/web/20201026070426/https://josehernandez.es/2011/01/18/servicio-web-php.html
 */

include 'GestionAutomoviles.php';

//$test = new GestionAutomoviles;
//$test->TestBD(); 

$soap = new SoapServer(null, array('uri' => 'http://dwes.infinityfreeapp.com/soap-automoviles/',
    "location" => "http://dwes.infinityfreeapp.com/soap-automoviles/service-automoviles-auth.php"));
$soap->setClass('GestionAutomoviles');
$soap->handle();

