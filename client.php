<?php

class Client
{
    private $instance;
    public function __construct()
    {
        $params = array(
            'uri' => 'http://localhost/soap-automoviles',
            'location' => 'http://localhost/soap-automoviles/serviceLocal-automoviles.php',
            'trace' => 1
        );

        $this->instance = new SoapClient(null, $params);

        $params = array(
            'username' => 'valentin',
            'password' => 'daw'
        );

        $head_params = new SoapVar($params, SOAP_ENC_OBJECT);
        $header = new SoapHeader("http://localhost/serviceLocal-automoviles.php", "authenticate", $head_params, false);
        $this->instance->__setSoapHeaders(array($header));
    }

    public function ObtenerMarcasUrl()
    {
        return $this->instance->ObtenerMarcasUrl();
    }

    public function ObtenerModelosPorMarca($marca)
    {
        return $this->instance->ObtenerModelosPorMarca($marca);
    }
}

$client = new Client();



