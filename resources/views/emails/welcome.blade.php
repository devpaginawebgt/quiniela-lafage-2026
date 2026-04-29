<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a la {{ config('app.name') }} 2026</title>
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
                                alt="Quiniela Lafage 2026" width="180"
                                style="display:block; max-width:180px; height:auto;">
                        </td>
                    </tr>

                    <!-- Bienvenida -->
                    <tr>
                        <td align="center" style="padding:36px 30px 8px 30px;">
                            <h1
                                style="margin:0 0 12px 0; font-size:26px; line-height:1.25; color:#202453; font-weight:bold;">
                                ¡Bienvenido a la {{ config('app.name') }} 2026!
                            </h1>
                            <p style="margin:0; color:#1b1c1b; font-size:15px; line-height:1.6;">
                                Pronostica los marcadores, sigue el torneo jornada a jornada y disfrútalo junto al
                                resto de participantes.
                            </p>
                        </td>
                    </tr>

                    <!-- CTA principal -->
                    <tr>
                        <td align="center" style="padding:8px 30px 8px 30px;">
                            <a href="https://placeholder.com"
                                style="display:inline-block; background:#f44236; color:#fafafa; text-decoration:none; padding:14px 32px; border-radius:8px; font-weight:bold; font-size:15px; letter-spacing:0.3px;">
                                Accede a la plataforma web
                            </a>
                        </td>
                    </tr>

                    <!-- Tiendas de apps -->
                    <tr>
                        <td align="center" style="padding:8px 30px 8px 30px;">
                            <p style="margin:0 0 14px 0; color:#1b1c1b; font-size:14px;">
                                ¡Ó descarga la aplicación móvil!  
                            </p>
                            <table cellpadding="0" cellspacing="0" style="margin:0 auto;">
                                <tr>
                                    <td style="padding:0 8px;" align="center" valign="middle">
                                        <a href="https://placeholder.com" style="text-decoration:none;">
                                            <img src="{{ rtrim(config('app.url'), '/') . '/images/decoracion/play_store.png' }}"
                                                alt="Descargar en Google Play" width="147" height="46"
                                                style="display:block; border:0; outline:none; width:147px; height:46px;">
                                        </a>
                                    </td>
                                    <td style="padding:0 8px;" align="center" valign="middle">
                                        <a href="https://placeholder.com" style="text-decoration:none;">
                                            <img src="{{ rtrim(config('app.url'), '/') . '/images/decoracion/app_store.png' }}"
                                                alt="Descargar en App Store" width="133" height="46"
                                                style="display:block; border:0; outline:none; width:133px; height:46px;">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Separador -->
                    <tr>
                        <td style="padding:24px 30px 0 30px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="border-top:1px solid #cfcfcf; height:1px; line-height:1px; font-size:0;">
                                        &nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Encabezado de secciones -->
                    <tr>
                        <td style="padding:24px 30px 4px 30px;">
                            <h2 style="margin:0 0 6px 0; font-size:18px; color:#202453; font-weight:bold;">
                                Conoce la plataforma
                            </h2>
                            <p style="margin:0; font-size:13px; line-height:1.5;">
                                Estos son los apartados que verás en la quiniela:
                            </p>
                        </td>
                    </tr>

                    <!-- Próximos partidos -->
                    <tr>
                        <td style="padding:18px 30px 0 30px;">
                            <h3 style="margin:0 0 6px 0; font-size:16px; color:#202453; font-weight:bold;">
                                Próximos partidos
                            </h3>
                            <p style="margin:0 0 8px 0; color:#1b1c1b; font-size:14px; line-height:1.55;">
                                Tu pantalla principal: aquí ves los partidos que están por jugarse y registras tu
                                pronóstico antes del pitazo inicial. Recuerda dejarlo a tiempo para que sume en la
                                jornada.
                            </p>
                            <a href="{{ route('web.proximos-partidos') }}"
                                style="color:#f44236; text-decoration:none; font-size:13px; font-weight:bold;"
                                target="_blank">
                                Ir a Próximos partidos &nbsp;&gt;
                            </a>
                        </td>
                    </tr>

                    <!-- Resultados -->
                    <tr>
                        <td style="padding:18px 30px 0 30px;">
                            <h3 style="margin:0 0 6px 0; font-size:16px; color:#202453; font-weight:bold;">
                                Resultados
                            </h3>
                            <p style="margin:0 0 8px 0; color:#1b1c1b; font-size:14px; line-height:1.55;">
                                Revisa cómo te fue jornada por jornada: marcador real, tu predicción y los puntos
                                ganados según el acierto (marcador exacto, ganador, empate, etc.).
                            </p>
                            <a href="{{ route('web.mis-predicciones') }}"
                                style="color:#f44236; text-decoration:none; font-size:13px; font-weight:bold;"
                                target="_blank">
                                Ir a Resultados &nbsp;&gt;
                            </a>
                        </td>
                    </tr>

                    <!-- Partidos -->
                    <tr>
                        <td style="padding:18px 30px 0 30px;">
                            <h3 style="margin:0 0 6px 0; font-size:16px; color:#202453; font-weight:bold;">
                                Partidos
                            </h3>
                            <p style="margin:0 0 8px 0; color:#1b1c1b; font-size:14px; line-height:1.55;">
                                Calendario completo del torneo agrupado por jornadas. Útil para repasar grupos, fases
                                eliminatorias y planear tus próximas predicciones.
                            </p>
                            <a href="{{ route('web.partidos') }}"
                                style="color:#f44236; text-decoration:none; font-size:13px; font-weight:bold;"
                                target="_blank">
                                Ir a Partidos &nbsp;&gt;
                            </a>
                        </td>
                    </tr>

                    <!-- Ranking -->
                    <tr>
                        <td style="padding:18px 30px 0 30px;">
                            <h3 style="margin:0 0 6px 0; font-size:16px; color:#202453; font-weight:bold;">
                                Ranking
                            </h3>
                            <p style="margin:0 0 8px 0; color:#1b1c1b; font-size:14px; line-height:1.55;">
                                Tabla general de participantes ordenada por puntos acumulados. Sigue cómo va el grupo
                                jornada a jornada y celebra a quienes vienen acertando.
                            </p>
                            <a href="{{ route('web.users.ranking') }}"
                                style="color:#f44236; text-decoration:none; font-size:13px; font-weight:bold;"
                                target="_blank">
                                Ir a Ranking &nbsp;&gt;
                            </a>
                        </td>
                    </tr>

                    <!-- Perfil -->
                    <tr>
                        <td style="padding:18px 30px 28px 30px;">
                            <h3 style="margin:0 0 6px 0; font-size:16px; color:#202453; font-weight:bold;">
                                Perfil
                            </h3>
                            <p style="margin:0 0 8px 0; color:#1b1c1b; font-size:14px; line-height:1.55;">
                                Tus datos personales, foto y resumen de puntos. Desde aquí puedes actualizar tu
                                información y revisar tu progreso global.
                            </p>
                            <a href="{{ route('web.users.perfil') }}"
                                style="color:#f44236; text-decoration:none; font-size:13px; font-weight:bold;"
                                target="_blank">
                                Ir a Perfil &nbsp;&gt;
                            </a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="padding:20px; background:#202453; color:#FFFFFF; font-size:12px; line-height:1.6;">
                            Quiniela Lafage 2026 &middot; ¡Disfruta del torneo y comparte la emoción con el grupo!
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
