<?php
// guardar.php

// Usaremos la conexión a BD PaaS (Azure Database)
require 'config-paas.php'; // Este archivo ahora retorna $conn como un objeto PDO

echo "<div style='font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px; color: #333; background-color: #f5f5f5;'>";

// Verificar que los datos del formulario POST existan
if (!isset($_POST['matricula']) || !isset($_POST['nombre']) || !isset($_POST['carrera'])) {
    die("<div style='background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;'>Error: Faltan datos en el formulario. Asegúrate de enviar matricula, nombre y carrera.</div>");
}

$matricula = trim($_POST['matricula']); // Limpiar espacios al inicio/final
$nombre = trim($_POST['nombre']);
$carrera = trim($_POST['carrera']);

// Valida que los campos no estén completamente vacíos después de trim
if (empty($matricula) || empty($nombre) || empty($carrera)) {
    die("<div style='background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;'>Error: Todos los campos (Matrícula, Nombre, Carrera) son obligatorios y no pueden estar vacíos.</div>");
}

try {
    // --- IMPORTANTE: Usar Prepared Statements para prevenir Inyección SQL ---
    $sql = "INSERT INTO alumnos (matricula, nombre, carrera) VALUES (:matricula, :nombre, :carrera)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':carrera', $carrera, PDO::PARAM_STR);

    $stmt->execute();

    echo "<div style='background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;'>Conexión exitosa a la base de datos SQL Server! Registro guardado exitosamente.</div>";
    echo "<a href='index.html' style='display: inline-block; margin-top: 10px; color: #3498db; text-decoration: none; font-weight: 600; padding: 8px 0; transition: color 0.3s;'>Regresar al formulario</a>";
    echo "<br>";
    //echo "<a href='consultar.php' style='display: inline-block; margin-top: 10px; color: #3498db; text-decoration: none; font-weight: 600; padding: 8px 0; transition: color 0.3s;'>Ver todos los registros</a>";

} catch (PDOException $e) {
    echo "<div style='background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;'>Error al guardar el registro: " . $e->getMessage() . "</div>";
    echo "<a href='index.html' style='display: inline-block; margin-top: 10px; color: #3498db; text-decoration: none; font-weight: 600; padding: 8px 0; transition: color 0.3s;'>Regresar al formulario</a>";
}

echo "</div>"; // Cierre del div principal
?>
