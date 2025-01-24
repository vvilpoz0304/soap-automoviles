<?php

include 'GestionAutomovilesAuth.php';


$soap = new SoapServer(null, array('uri' => 'http://localhost/soap-automoviles/',
    'location' => 'http://localhost/soap-automoviles/GestionAutomovilesAuth.php',
    'trace' => 1));
$soap->setClass('GestionAutomovilesAuth');
$soap->handle();

function authenticate($header_params)
{

    if ($header_params->username == 'valentin' && $header_params->password == 'daw') {
        return true;
    } else throw new SoapFault('Wrong user/pass combination', 401);
}