<?php
    $client = new SoapClient(null, array('uri' => 'http://localhost/soap-automoviles',
        'location' => 'http://localhost/soap-automoviles/serviceLocal-automoviles.php',
        'trace' => 1));

    $params = array(
        'username' => 'ies',
        'password' => 'daw'
    );

    $head_params = new SoapVar($params, SOAP_ENC_OBJECT);
    $header = new SoapHeader("http://localhost/serviceLocal-automoviles.php", "authenticate", $head_params, false);
    $client->__setSoapHeaders($header);





