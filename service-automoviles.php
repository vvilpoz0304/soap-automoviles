<?php
/*
 * Servicio Web en PHP por Jose Hernández
 * https://josehernandez.es/2011/01/18/servicio-web-php.html
 * https://web.archive.org/web/20201026070426/https://josehernandez.es/2011/01/18/servicio-web-php.html
 */

include 'GestionAutomovilesAuth.php';

//$test = new GestionAutomovilesAuth;
//$test->TestBD(); 

$soap = new SoapServer(null, array('uri' => 'http://dwes.infinityfreeapp.com/soap-automoviles/',
    'location' => 'http://dwes.infinityfreeapp.com/soap-automoviles/service-automoviles-auth.php',
    'trace' => 1));
$soap->setClass('GestionAutomovilesAuth');
$soap->handle();

