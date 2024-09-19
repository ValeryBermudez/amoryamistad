<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vamos a jugar Amigo Secreto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Vamos a jugar Amigo Secreto</h1>
        <form action="descubrir.php" method="GET">
            <p>Por favor ingresa los datos correctamente para que no hayan confusiones :p.</p>
            <br>
            <p>Si dice primer nombre, ponlo como es en tu documento de identidad. Tenkiu</p>
            <input type="text" name="nombre" placeholder="Primer Nombre" required>
            <input type="text" name="apellido" placeholder="Primer Apellido" required>
            <button type="submit">Descubrir Amigo Secreto</button>
        </form>
    </div>
</body>
</html>
