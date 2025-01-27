<?php
class Coches {
    private $con;
    private $authenticated;

    public function __construct()
    {
        $this->con = $this->connection();
        $this->authenticated = false;
    }
    function connection()
    {
        try {
            include_once "db_params.php"; // Declaramos los datos de la base datos en el archivo "db_params.php"
            $con = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        }catch (PDOException $e){
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    // Funcion para autenticar el usuario;
    function authenticate($header_params)
    {

        if ($header_params->username == 'valentin' && $header_params->password == 'daw') {
            return true;
        } else throw new SoapFault('Wrong user/pass combination', 401);
    }

    // Funcion para obtener las marcas y las url de los videos;
    function ObtenerMarcasUrl(){

        // En caso de que el usuario no esté autenticado o la conexion a la base de datos falle, se mostrará el error;
        if(!$this->authenticated){
            throw new SoapFault('Client', "User not authenticated.");
        }
        if(!$this->con){
            throw new SoapFault('Server', "Cannot connect the database.");
        }

        // Ejecutamos la sentencia;
        $stmt = $this->con->query('SELECT marca, url FROM marcas');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($result); // Serializamos el resultado;
    }

    function ObtenerModelos($marca) {

        if(!$this->authenticated){
            throw new SoapFault('Client', "User not authenticated.");
        }
        if(!$this->con){
            throw new SoapFault('Server', "Cannot connect the database.");
        }

        $marca = intVal($marca);
        $modelos = array();

            if ($con) {
                // HAcemnos un prepare statement mediante un subselect, obtenemos el modelo el cual la marca es igual al id de la marca pasada;
                $stmt = 'SELECT modelo FROM modelos WHERE marca = (SELECT id FROM marcas WHERE marca = ?)';
                $stmt = $con->prepare($stmt);
                $stmt-> bindParam(1, $marca);
                $stmt->execute();

                $modelos = $stmt->fetchAll(PDO::FETCH_ASSOC);


            }
            $result = $modelos;

        return json_encode($modelos);
    }


}