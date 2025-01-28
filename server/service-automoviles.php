<?php

include 'Coches.php';

$soap = new SoapServer(null, array('uri' => 'http://valentinvilla.great-site.net/soap-ajax/service-automoviles.php'));
$soap->setClass('Coches');
$soap->handle();

