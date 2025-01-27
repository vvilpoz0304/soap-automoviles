<?php

try {
    $client = new SoapClient(null, array('uri' => 'http://valentinvilla.great-site.net/soap-ajax/client',
        'location' => 'http://valentinvilla.great-site.net/soap-ajax/server/service-automoviles.php',
        'trace' => 1
    ));

    $authparams = array(
        'username' => 'valentin',
        'password' => 'daw'
    );

    $header_params = new SoapVar($authparams, SOAP_ENC_OBJECT);
    $header = new SoapHeader('http://valentinvilla.great-site.net/soap-ajax/server/service-automoviles.php', 'authenticate', $header_params, false);
    $client->__setSoapHeaders(array($header));
    $marcas = $client->ObtenerMarcasUrl();
    $marcas = json_decode($marcas, true);

} catch (SoapFault $e) {
    echo "SOAP Fault: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
