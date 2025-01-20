<?php
class GestionAutomoviles {

    public function __construct() {
        $params = array('location' => 'http://dwes.infinityfreeapp.com/soap-automoviles/',
            'uri' => 'http://dwes.infinityfreeapp.com/soap-automoviles/service-automoviles-auth.php',
            'trace' => 1);
        $this->instance = new SoapClient(null, $params);

        $auth_params = new stdClass();
        $auth_params->username = 'ies';
        $auth_params->password = 'daw';
        self::authenticate($auth_params);

        $header_params = new SoapVar($auth_params, SOAP_ENC_OBJECT);
        $header = new SoapHeader('http://localhost/soap-server/', 'authenticate', $header_params, false);
        $this->instance->__setSoapHeaders(array($header));

    }
    public function TestBD() {
        $con = $this->ConectarMarcas();
    }

    // Funcion para conectarse a la base de datos
    public function ConectarMarcas() {
        try {
            $user = "coches";  // usuario con el que se va conectar con MySQL
            $pass = "coches";  // contraseña del usuario
            $dbname = "coches";  // nombre de la base de datos
            $host = "localhost";  // nombre o IP del host

            $db = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);  //conectar con MySQL y SELECCIONAR la Base de Datos
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //Manejo de errores con PDOException
            echo "<p>Se ha conectado a la BD $dbname.</p>\n";
            return $db;

        } catch (PDOException $e) {  // Si hubieran errores de conexión, se captura un objeto de tipo PDOException
            print "<p>Error: No se pudo conectar con la BD $dbname.</p>\n";
            print "<p>Error: " . $e->getMessage() . "</p>\n";  // mensaje de excepción

            exit();  // terminar si no hay conexión $db
        }
    }

    // Función para obtener los nombres de las marcas
    public function ObtenerMarcas() {
        $con = $this->ConectarMarcas();

        $marcas = array();
        if ($con) {
            $result = $con->query('select id, marca from marcas');

            while ($row = $result->fetch(PDO::FETCH_ASSOC))
                $marcas[$row['id']] = $row['marca'];
        }
        return $marcas;
    }

    // Funcion para obtener la url de las marcas;
    public function ObtenerMarcasUrl()
    {
        $con = $this->ConectarMarcas();
        $url = "";

        if($con) {
            $result = $con->query('SELECT url FROM marcas');
            while ($row = $result->fetch(PDO::FETCH_ASSOC));
                $url = $row['url'];
        }
        return $url;
    }

    public function ObtenerModelosPorMarca($marca)
    {
        $con = $this->ConectarMarcas();
        $modelos = array();

        if ($con) {
            $result = $con->query('select * from modelos where marca="'.$marca.'"');

            while ($row = $result->fetch(PDO::FETCH_ASSOC))
                $modelos[] = $row['modelo'];
        }
        return $modelos;
    }



    public function ObtenerModelos($marca) {
        $marca = intVal($marca);
        $modelos = array();

        if ($marca !== 0) {
            $con = $this->ConectarMarcas();
            $con->query("SET CHARACTER SET utf8");

            if ($con) {
                $result = $con->query('select id, modelo from modelos ' .
                    'where marca = ' . $marca);

                while ($row = $result->fetch(PDO::FETCH_ASSOC))
                    $modelos[$row['id']] = $row['modelo'];
            }
        }

        return $modelos;
    }

    public static function authenticate($header_params) {

        if($header_params->username == 'ies' && $header_params->password == 'daw') {

            return true;

        }

        else throw new SoapFault('Wrong user/pass combination', 401);

    }
}
