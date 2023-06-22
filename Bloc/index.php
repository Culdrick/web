<!DOCTYPE html>
<html>
<head>
    <title>Blog de Notas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .note-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .note {
            width: 300px;
            margin: 10px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .note-title {
            font-weight: bold;
            text-align: center;
            margin-bottom: 5px;
        }
        .note-content {
            text-align: center;
            margin-bottom: 10px;
        }
        .note-actions {
            text-align: center;
        }
        .note-actions button {
            margin-top: 10px;
            padding: 5px 10px;
            border-radius: 3px;
            background-color: #f44336;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .note-actions button.edit {
            background-color: #4caf50;
        }
        .note-actions button:hover {
            opacity: 0.8;
        }
        .note-form {
            text-align: center;
            margin-top: 20px;
        }
        .note-form input[type="text"],
        .note-form textarea {
            margin-bottom: 10px;
            padding: 5px;
            font-size: 14px;
            text-align: center;
        }
        .note-form input[type="submit"] {
            padding: 5px 10px;
            border-radius: 3px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .note-form input[type="submit"]:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h2>Blog de Notas</h2>

    <?php
    $notesDir = 'notes/';

    // Función para obtener todas las notas
    function getNotes() {
        global $notesDir;

        if (!file_exists($notesDir)) {
            mkdir($notesDir, 0777, true);
        }

        $notes = [];

        $files = array_diff(scandir($notesDir), array('.', '..'));
        foreach ($files as $file) {
            $noteContent = file_get_contents($notesDir . $file);
            $notes[$file] = $noteContent;
        }

        return $notes;
    }

    // Guardar o actualizar una nota
    if (isset($_POST['submit'])) {
        $noteTitle = $_POST['note_title'];
        $noteContent = $_POST['note_content'];

        $noteFile = $notesDir . $noteTitle;

        file_put_contents($noteFile, $noteContent);

        echo "<p>Nota guardada correctamente.</p>";
    }

    // Eliminar una nota
    if (isset($_POST['delete'])) {
        $noteTitle = $_POST['note_title'];

        $noteFile = $notesDir . $noteTitle;

        if (file_exists($noteFile)) {
            unlink($noteFile);
            echo "<p>Nota eliminada correctamente.</p>";
        } else {
            echo "<p>No se pudo encontrar la nota.</p>";
        }
    }

    // Mostrar todas las notas existentes
    $notes = getNotes();
    if (!empty($notes)) {
        echo '<div class="note-container">';
        foreach ($notes as $noteTitle => $noteContent) {
            echo '<div class="note">
                    <div class="note-title">' . $noteTitle . '</div>
                    <div class="note-content">' . nl2br($noteContent) . '</div>
                    <div class="note-actions">
                        <form method="post" action="">
                            <input type="hidden" name="note_title" value="' . $noteTitle . '">
                            <button type="submit" name="delete">Eliminar</button>
                            <button type="button" class="edit" onclick="editNote(\'' . $noteTitle . '\')">Editar</button>
                        </form>
                    </div>
                </div>';
        }
        echo '</div>';
    } else {
        echo "<p>No hay notas disponibles.</p>";
    }
    ?>

    <h2>Agregar nueva nota o editar una existente</h2>
    <div class="note-form">
        <form method="post" action="">
            <input type="text" name="note_title" placeholder="Título de la nota" required>
            <br>
            <textarea name="note_content" placeholder="Escribe aquí tu nota..." required></textarea>
            <br>
            <input type="submit" name="submit" value="Guardar nota">
            <button type="button" onclick="cancelEdit()">Cancelar</button>
        </form>
    </div>

    <script>
        function editNote(title) {
            var form = document.querySelector('.note-form form');
            form.elements['note_title'].value = title;
            form.elements['note_content'].value = '<?php echo addslashes($notesDir); ?>' + title;
        }

        function cancelEdit() {
            var form = document.querySelector('.note-form form');
            form.elements['note_title'].value = '';
            form.elements['note_content'].value = '';
        }
    </script>
</body>
</html>
