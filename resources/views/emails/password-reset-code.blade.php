<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu código de recuperación</title>
</head>

<body style="margin:0; padding:0; font-family: Arial, Helvetica, sans-serif; color:#1b1c1b; background:#e7e8ec;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0; background:#e7e8ec;">
        <tr>
            <td align="center">

                <!-- Contenedor principal -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="width:600px; max-width:600px; background:#fafafa; border-radius:12px; overflow:hidden; box-shadow:0 2px 8px rgba(27,28,27,0.08);">

                    <!-- Cabecera con logo -->
                    <tr>
                        <td align="center" style="padding:40px 20px 32px 20px; background:#202453;">
                            <img src="{{ rtrim(config('app.url'), '/') . '/images/logos/logo-white.png' }}"
                                alt="{{ config('app.name') }}" width="180"
                                style="display:block; max-width:180px; height:auto;">
                        </td>
                    </tr>

                    <!-- Encabezado -->
                    <tr>
                        <td align="center" style="padding:36px 30px 8px 30px;">
                            <h1
                                style="margin:0 0 12px 0; font-size:24px; line-height:1.3; color:#202453; font-weight:bold;">
                                Hola {{ $user->nombres }}, recuperemos tu contraseña
                            </h1>
                            <p style="margin:0; color:#1b1c1b; font-size:15px; line-height:1.6;">
                                Recibimos una solicitud para restablecer la contraseña de tu cuenta. Usa el siguiente
                                código en la aplicación para continuar.
                            </p>
                        </td>
                    </tr>

                    <!-- Caja del código OTP -->
                    <tr>
                        <td align="center" style="padding:28px 30px 8px 30px;">
                            <table cellpadding="0" cellspacing="0"
                                style="background:#ffffff; border:1px solid #cfcfcf; border-radius:10px;">
                                <tr>
                                    <td align="center"
                                        style="padding:20px 36px; color:#202453; font-size:36px; font-weight:bold; letter-spacing:8px; font-family: 'Courier New', Courier, monospace;">
                                        {{ $code }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Aviso de expiración -->
                    <tr>
                        <td align="center" style="padding:8px 30px 24px 30px;">
                            <p style="margin:0; color:#9c9c9c; font-size:12px; line-height:1.5;">
                                Este código expira en {{ $expiresInMinutes }} minutos.
                            </p>
                        </td>
                    </tr>

                    <!-- Separador -->
                    <tr>
                        <td style="padding:0 30px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="border-top:1px solid #cfcfcf; height:1px; line-height:1px; font-size:0;">
                                        &nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Aviso seguridad -->
                    <tr>
                        <td style="padding:24px 30px 28px 30px;">
                            <p style="margin:0; color:#9c9c9c; font-size:12px; line-height:1.55;">
                                ¿No solicitaste este cambio? Puedes ignorar este correo y tu contraseña actual seguirá
                                siendo la misma.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="padding:20px; background:#202453; color:#FFFFFF; font-size:12px; line-height:1.6;">
                            {{ config('app.name') }} 2026
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
