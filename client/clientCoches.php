<?php

try {
    $client = new SoapClient(null, array('uri' => 'http://localhost/soap-automoviles/client',
        'location' => 'http://localhost/soap-automoviles/server/service-automoviles.php',
        'trace' => 1
    ));

    $authparams = array(
        'username' => 'valentin',
        'password' => 'daw'
    );

    $header_params = new SoapVar($authparams, SOAP_ENC_OBJECT);
    $header = new SoapHeader('http://localhost/soap-automoviles/server/service-automoviles.php', 'authenticate', $header_params, false);
    $client->__setSoapHeaders(array($header));


} catch (SoapFault $e) {
    echo "SOAP Fault: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
