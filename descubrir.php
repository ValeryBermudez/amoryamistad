<?php
// Leer la lista de amigos del archivo JSON
$amigos = json_decode(file_get_contents('amigos.json'), true);

// Función para normalizar nombres
function normalizar_nombre($nombre) {
    return strtolower(trim($nombre));
}

// Leer el nombre y apellido del usuario que ha hecho clic
if (isset($_GET['nombre']) && isset($_GET['apellido'])) {
    $nombreIngresado = normalizar_nombre($_GET['nombre']);
    $apellidoIngresado = normalizar_nombre($_GET['apellido']);
    $nombreCompletoIngresado = $nombreIngresado . ' ' . $apellidoIngresado;

    // Verificar si el nombre completo está registrado
    $encontrado = false;
    foreach ($amigos as $amigo) {
        if (normalizar_nombre($amigo) === $nombreCompletoIngresado) {
            $nombre = $amigo; // Usuario encontrado
            $encontrado = true;
            break;
        }
    }

    // Si el usuario está registrado
    if ($encontrado) {
        // Crear la lista de posibles asignaciones
        $amigosDisponibles = $amigos;
        shuffle($amigosDisponibles);

        // Encontrar el amigo secreto para el usuario
        $asignado = null;
        foreach ($amigosDisponibles as $amigo) {
            if ($amigo != $nombre) {
                $asignado = $amigo;
                break;
            }
        }

        // Mostrar el amigo secreto asignado
        if ($asignado) {
            $mensajes = [
                "Eres mi lugar favorito en este mundo.",
                "Un amigo como tú es un tesoro invaluable.",
                "Contigo, cada momento es una aventura.",
                "La risa compartida es la mejor medicina.",
                "Tu sonrisa ilumina mis días más oscuros.",
                "Gracias por ser mi cómplice en locuras.",
                "Eres el sueño del que nunca quiero despertar.",
                "Juntos somos imparables, siempre a tu lado.",
                "Tus abrazos son mi refugio favorito.",
                "La amistad contigo es un regalo que valoro siempre."
            ];
            $mensaje = $mensajes[array_rand($mensajes)];
        } else {
            $asignado = "No se encontró un amigo secreto.";
            $mensaje = "";
        }
    } else {
        $asignado = "No estás registrado.";
        $mensaje = "";
    }
} else {
    $asignado = "Nombre no encontrado.";
    $mensaje = "";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubre tu Amigo Secreto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Eres <?php echo $nombre ?? 'No encontrado'; ?></h1>
        <p>Tu amigo secreto es: <?php echo $asignado; ?></p>
        <p><?php echo $mensaje; ?></p>
    </div>
</body>
</html>
