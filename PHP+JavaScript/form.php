<?php
$nombre = $email = $edad = "";
$errorNombre = $errorEmail = $errorEdad = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) {
        $errorNombre = "El nombre es requerido.";
    } else {
        $nombre = htmlspecialchars(trim($_POST["nombre"]));
    }

    if (empty($_POST["email"])) {
        $errorEmail = "El email es requerido.";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorEmail = "El email no es válido.";
        }
    }

    if (empty($_POST["edad"])) {
        $errorEdad = "La edad es requerida.";
    } else {
        $edad = intval($_POST["edad"]);
        if ($edad < 18 || $edad > 99) {
            $errorEdad = "La edad debe estar entre 18 y 99.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario con Validación PHP</title>
    <style>
        .error { color: red; font-size: 0.9em; }
        .campo { margin-bottom: 1em; }
    </style>
</head>
<body>
    <form method="post" action="">
        <div class="campo">
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
            <div class="error"><?php echo $errorNombre; ?></div>
        </div>
        <div class="campo">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="error"><?php echo $errorEmail; ?></div>
        </div>
        <div class="campo">
            <label for="edad">Edad:</label><br>
            <input type="number" id="edad" name="edad" min="18" max="99" value="<?php echo htmlspecialchars($edad); ?>">
            <div class="error"><?php echo $errorEdad; ?></div>
        </div>
        <button type="submit">Enviar</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !$errorNombre && !$errorEmail && !$errorEdad) {
        echo "<p>Formulario enviado correctamente.</p>";
    }
    ?>
</body>
</html>