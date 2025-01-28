<?php
include "client/client.php";

$marca = isset($_GET["marca"]) ? $_GET["marca"] : $marca = "Ford";

try{
    $modelos = $client->ObtenerModelos($marca);
    $modelos = json_decode($modelos, true);

    // Validamos de que "modelos" sea un array para que no haya ningun error.
    if(!is_array($modelos)){
        throw new Exception("Modelos no encontrado");
    }
} catch (SoapFault $exception) {
    throw new Exception($exception->getMessage());
} catch (Exception $exception) {
    throw new Exception($exception->getMessage());
}

?>
    <h2>Modelos disponibles de la marca: <?= $marca ?> </h2>

<?php
if(is_array($modelos) && !empty($modelos)){
    foreach($modelos as $modelo){
        ?>
        <figure>
            <img src="img/<?= strtolower($marca) ?>.png" alt="logo <?= $marca ?>" height="60" width="100"/>
            <figcaption><?= $modelo["modelo"] ?></figcaption>
        </figure>
        <?php

    }
} else {
    echo "<p>No hay modelos disponibles para la marca seleccionada.</p>";
}

?>

</body>
</html>