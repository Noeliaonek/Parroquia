<?php
// Configura los datos de tu correo
$destinatario = "noeliahuanca320@gmail.com"; // Cambia por el correo de la secretaria
$asunto = "Nuevo mensaje desde el formulario de contacto";

// Validar si se recibieron los datos correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar y obtener los datos del formulario
    $nombre = htmlspecialchars($_POST['nom']);
    $correo = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
    $mensaje = htmlspecialchars($_POST['message']);

    // Verificar que los campos requeridos no estén vacíos
    if (!empty($nombre) && !empty($correo) && !empty($mensaje)) {
        // Crear el cuerpo del correo
        $cuerpoMensaje = "Has recibido un nuevo mensaje desde el formulario de contacto.\n\n";
        $cuerpoMensaje .= "Nombre: $nombre\n";
        $cuerpoMensaje .= "Correo electrónico: $correo\n\n";
        $cuerpoMensaje .= "Mensaje:\n$mensaje\n";

        // Enviar el correo
        $headers = "From: $correo\r\n";
        $headers .= "Reply-To: $correo\r\n";

        if (mail($destinatario, $asunto, $cuerpoMensaje, $headers)) {
            echo "<script>alert('¡Mensaje enviado con éxito!'); window.location.href = 'CONTACTOS.html';</script>";
        } else {
            echo "<script>alert('Error al enviar el mensaje. Por favor, intenta de nuevo más tarde.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Por favor, completa todos los campos.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Método no permitido.'); window.history.back();</script>";
}
?>