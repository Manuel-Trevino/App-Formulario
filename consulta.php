<?php
// consultar.php

// Usaremos la conexión a BD PaaS (Azure Database)
require 'config-paas.php';

echo "<div style='background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;'>Conexión exitosa a la base de datos SQL Server!</div>";

try {
    $sql = "SELECT id, matricula, nombre, carrera, fecha_registro FROM alumnos ORDER BY id DESC";
    $stmt = $conn->query($sql);

    echo "<div style='font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; max-width: 800px; margin: 0 auto; padding: 20px; color: #333; background-color: #f5f5f5;'>";
    echo "<h1 style='color: #2c3e50; text-align: center; margin-bottom: 30px; padding-bottom: 10px; border-bottom: 2px solid #3498db;'>Registros de Alumnos</h1>";

    $first_row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($first_row) {
        echo "<div style='background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);'>";
        echo "<table style='width: 100%; border-collapse: collapse;'>";
        echo "<thead>";
        echo "<tr style='background-color: #3498db; color: white;'>";
        echo "<th style='padding: 12px; text-align: left;'>ID</th>";
        echo "<th style='padding: 12px; text-align: left;'>Matrícula</th>";
        echo "<th style='padding: 12px; text-align: left;'>Nombre</th>";
        echo "<th style='padding: 12px; text-align: left;'>Carrera</th>";
        echo "<th style='padding: 12px; text-align: left;'>Fecha Registro</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Función para alternar colores de fila
        $row_color = true;
        
        // Mostrar primera fila
        echo "<tr style='background-color: " . ($row_color ? '#f9f9f9' : 'white') . ";'>";
        echo "<td style='padding: 10px; border-bottom: 1px solid #eee;'>" . htmlspecialchars($first_row['id']) . "</td>";
        echo "<td style='padding: 10px; border-bottom: 1px solid #eee;'>" . htmlspecialchars($first_row['matricula']) . "</td>";
        echo "<td style='padding: 10px; border-bottom: 1px solid #eee;'>" . htmlspecialchars($first_row['nombre']) . "</td>";
        echo "<td style='padding: 10px; border-bottom: 1px solid #eee;'>" . htmlspecialchars($first_row['carrera']) . "</td>";
        echo "<td style='padding: 10px; border-bottom: 1px solid #eee;'>" . htmlspecialchars($first_row['fecha_registro']) . "</td>";
        echo "</tr>";
        $row_color = !$row_color;

        // Mostrar filas restantes
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr style='background-color: " . ($row_color ? '#f9f9f9' : 'white') . ";'>";
            echo "<td style='padding: 10px; border-bottom: 1px solid #eee;'>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td style='padding: 10px; border-bottom: 1px solid #eee;'>" . htmlspecialchars($row['matricula']) . "</td>";
            echo "<td style='padding: 10px; border-bottom: 1px solid #eee;'>" . htmlspecialchars($row['nombre']) . "</td>";
            echo "<td style='padding: 10px; border-bottom: 1px solid #eee;'>" . htmlspecialchars($row['carrera']) . "</td>";
            echo "<td style='padding: 10px; border-bottom: 1px solid #eee;'>" . htmlspecialchars($row['fecha_registro']) . "</td>";
            echo "</tr>";
            $row_color = !$row_color;
        }
        
        echo "</tbody>";
        echo "</table>";
        echo "</div>"; // Cierre del div con fondo blanco
    } else {
        echo "<div style='background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-top: 20px; text-align: center;'>No se encontraron registros de alumnos.</div>";
    }

    echo "<a href='registro.php' style='display: inline-block; margin-top: 20px; color: #3498db; text-decoration: none; font-weight: 600; padding: 8px 0; transition: color 0.3s;'>Regresar al formulario</a>";
    echo "</div>"; // Cierre del div principal

} catch (PDOException $e) {
    echo "<div style='background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin: 20px auto; max-width: 800px;'>Error al consultar los registros: " . $e->getMessage() . "</div>";
}
?>
