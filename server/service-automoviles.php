<?php

include 'Coches.php';

$soap = new SoapServer(null, array('uri' => 'http://localhost/soap-automoviles/server/service-automoviles.php'));
$soap->setClass('Coches');
$soap->handle();

