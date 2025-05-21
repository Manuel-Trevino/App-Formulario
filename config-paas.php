<?php
$serverName = "ser-bd01.database.windows.net"; // Opcional: puedes especificar el puerto si no es el 1433 predeterminado
$connectionOptions = array(
    "Database" => "Bd01",
    "Uid" => "admanuel",
    "PWD" => "manuel123." // ¡Recuerda, esto debe ir en variables de entorno en producción!
);

try {
    // Establecer la conexión con PDO_SQLSRV
    $conn = new PDO("sqlsrv:Server=$serverName;Database=" . $connectionOptions['Database'], $connectionOptions['Uid'], $connectionOptions['PWD']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilita el modo de error de excepciones para un mejor manejo de errores

    //echo "Conexión exitosa a la base de datos SQL Server!";


} catch (PDOException $e) {
    die("Conexión fallida a SQL Server: " . $e->getMessage());
}
?>
