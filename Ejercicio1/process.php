<?php
$empleados = array();

// Obtener los datos enviados por el formulario
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$estadoCivil = $_POST['estado_civil'];
$sexo = $_POST['sexo'];
$sueldo = $_POST['sueldo'];

// Agregar los datos del empleado al array de empleados
$empleado = array(
    'nombre' => $nombre,
    'edad' => $edad,
    'estado_civil' => $estadoCivil,
    'sexo' => $sexo,
    'sueldo' => $sueldo
);
$empleados[] = $empleado;

// Realizar los cálculos solicitados
$totalFemenino = 0;
$totalHombresCasados = 0;
$totalMujeresViudas = 0;
$totalEdadHombres = 0;
$contadorHombres = 0;

foreach ($empleados as $empleado) {
    if ($empleado['sexo'] == 'femenino') {
        $totalFemenino++;
    }
    if ($empleado['sexo'] == 'masculino') {
        if ($empleado['estado_civil'] == 'casado' && $empleado['sueldo'] == 'mas_de_2500') {
            $totalHombresCasados++;
        }
        if ($empleado['estado_civil'] == 'viudo' && $empleado['sueldo'] == 'mas_de_1000') {
            $totalMujeresViudas++;
        }
        $totalEdadHombres += $empleado['edad'];
        $contadorHombres++;
    }
}

$promedioEdadHombres = ($contadorHombres > 0) ? $totalEdadHombres / $contadorHombres : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resultado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Resultado</h2>
        <p>Total de empleados del sexo femenino: <?php echo $totalFemenino; ?></p>
        <p>Total de hombres casados que ganan más de 2500 Bs.: <?php echo $totalHombresCasados; ?></p>
        <p>Total de mujeres viudas que ganan más de 1000 Bs.: <?php echo $totalMujeresViudas; ?></p>
        <p>Edad promedio de los hombres: <?php echo $promedioEdadHombres; ?></p>
    </div>
    <script src="script.js"></script>
</body>
</html>
