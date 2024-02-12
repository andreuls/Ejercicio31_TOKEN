<?php

// creamos la cabecera para indicar que vamos a devolver un recurso REST
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// parámetros de conexión
$dbname = "fallas_valencia";
$host = "localhost"; // también podríamos haber puesto 127.0.0.1

// creamos la cadena de conexión
$strConexion = "mysql:dbname=$dbname;host=$host";

// creamos las credenciales del usuario
$usuario = "cangulo";
$clave = "12345678";

try {

    // creamos un objeto de la clase PDO
    $bd = new PDO($strConexion, $usuario, $clave);

    // si no se han encontrado fallas se devolverá el error
    if (!$bd) throw new Exception("Error en la conexión a la BD");

    // creamos la consulta con interrogantes
    $sql = "select nombre, presupuesto from fallas where presupuesto > ?";

    // preparamos la consulta
    $queryPreparada = $bd->prepare($sql);

    $presupuesto = (isset($_GET['presupuesto']) && $_GET['presupuesto']) ? $_GET['presupuesto'] : '0';

    // creamos el array de parámetros para los valores
    $arrParametros = [$presupuesto];

    // ejecutamos la consulta preparada
    $queryPreparada->execute($arrParametros);

    // si no se han encontrado fallas se devolverá el error
    if (!$queryPreparada->rowCount()) throw new Exception("fallas no encontradas");

    // definimos el array de fallas
    $arrFallas = [];

    // mostarmos todos los registros devueltos
    while($registro = $queryPreparada->fetch()) {
    
        // creamos el registro de la falla n-ésima
        $regFalla = [
            'nombre' => $registro["nombre"],
            'presupuesto' => $registro["presupuesto"]
        ];

        // guardamos la falla n-ésima en el array de fallas
        $arrFallas[] = $regFalla;
    }

    // definimos la cabecera HTTP con código OK
    http_response_code(200); 

    // definimos y enviamos el json con las fallas
    echo json_encode($arrFallas);
    
// si la conexión no ha tenido éxito lo indicamos    
} catch (PDOException $e) {

    // definimos la cabecera HTTP con el código de error
    http_response_code(204); 

    // definimos y enviamos el array con el mensaje de error
    $arrError = ["mensaje" => $e->getMessage()];
    echo json_encode($arrError);

// si no se han encontrado fallas se devuelve el error
} catch (Exception $e) {

    // definimos la cabecera HTTP con el código de error
    http_response_code(204); 

    // definimos y enviamos el array con el mensaje de error
    $arrError = ["mensaje" => $e->getMessage()];
    echo json_encode($arrError);
}
?>
