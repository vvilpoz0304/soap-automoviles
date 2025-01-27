<?php

include 'Coches.php';

$soap = new SoapServer(null, array('uri' => 'http://valentinvilla.great-site.net/soap-ajax/service-automoviles.php',
        'location' => 'http://valentinvilla.great-site.net/soap-ajax/server/Coches.php',
    'trace' => 1));
$soap->setClass('Coches');
$soap->handle();

