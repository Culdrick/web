<?php
session_start();
$notas = [];
if (isset($_SESSION['notas'])) {
    $notas = $_SESSION['notas'];
}
if (isset($_POST['guardar'])) {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $nota = ['titulo' => $titulo, 'contenido' => $contenido];
    $notas[] = $nota;
    $_SESSION['notas'] = $notas;
}
if (isset($_GET['editar'])) {
    $indice = $_GET['editar'];
    if (isset($notas[$indice])) {
        $nota = $notas[$indice];
    }
}
if (isset($_POST['actualizar'])) {
    $indice = $_POST['indice'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    if (isset($notas[$indice])) {
        $notas[$indice]['titulo'] = $titulo;
        $notas[$indice]['contenido'] = $contenido;
        $_SESSION['notas'] = $notas;
    }
}
if (isset($_GET['borrar'])) {
    $indice = $_GET['borrar'];
    if (isset($notas[$indice])) {
        unset($notas[$indice]);
        $_SESSION['notas'] = $notas;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog de Notas</title>
</head>
<body>
    <h1>Blog de Notas</h1>
    <h2>Crear/Editar Nota</h2>
    <form method="POST" action="">
        <input type="hidden" name="indice" value="<?php echo isset($indice) ? $indice : ''; ?>">
        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" id="titulo" value="<?php echo isset($nota['titulo']) ? $nota['titulo'] : ''; ?>"><br>
        <label for="contenido">Contenido:</label><br>
        <textarea name="contenido" id="contenido" rows="5" cols="50"><?php echo isset($nota['contenido']) ? $nota['contenido'] : ''; ?></textarea><br>
        <?php if (isset($indice)) { ?>
            <input type="submit" name="actualizar" value="Actualizar Nota">
        <?php } else { ?>
            <input type="submit" name="guardar" value="Guardar Nota">
        <?php } ?>
    </form>
    <h2>Notas</h2>
    <ul>
        <?php foreach ($notas as $indice => $nota) { ?>
            <li>
                <strong><?php echo $nota['titulo']; ?></strong>
                <p><?php echo $nota['contenido']; ?></p>
                <a href="index.php?editar=<?php echo $indice; ?>">Editar</a>
                <a href="index.php?borrar=<?php echo $indice; ?>">Borrar</a>
            </li>
        <?php } ?>
    </ul>
</body>
</html>
