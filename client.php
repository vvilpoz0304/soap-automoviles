<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Client
{
    private $instance;
    public function __construct()
    {
        $params = array('uri' => 'http://dwes.infinityfreeapp.com/soap-automoviles/',
            'location' => 'http://dwes.infinityfreeapp.com/soap-automoviles/service-automoviles-auth.php',
            'trace' => 1);

        $this->instance = new SoapClient(null, $params);

        $auth_params = new stdClass();
        $auth_params->username = 'valentin';
        $auth_params->password = 'daw';


        $head_params = new SoapVar($auth_params, SOAP_ENC_OBJECT);
        $header = new SoapHeader("http://dwes.infinityfreeapp.com/soap-automoviles/service-automoviles-auth.php", "authenticate", $head_params, false);
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



