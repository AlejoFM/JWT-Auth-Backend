<!DOCTYPE html>
<html>
<head>
    <title>Restablecimiento de Contraseña</title>
</head>
<body>
<h1>Restablecimiento de Contraseña</h1>
<p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
<a href="{{ url('reset-password/' . $admin->password_reset_token) }}">Restablecer Contraseña</a>
<p>Si no solicitaste un restablecimiento de contraseña, puedes ignorar este correo.</p>
</body>
</html>
