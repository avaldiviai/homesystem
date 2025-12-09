<!DOCTYPE html>
<html>
<head>
    <title>Recordatorio de Mantención</title>
    <style>
        /* General styles for email clients */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: rgb(255, 255, 255);
            text-align: center; /* Center-align all text */
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: linear-gradient(145deg, #ffffff, #eaeaea);
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 24px;
            border: 1px solid #dddddd;
            overflow: hidden;
            text-align: center; /* Center-align text inside the container */
        }
        .email-header {
            background: linear-gradient(90deg, #ff6f00, #ff8c00);
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-radius: 16px 16px 0 0;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;

        }
        .email-content {
            padding: 20px;
            font-size: 16px;
            line-height: 1.8;
            color: #555555;
            text-align: center; /* Center-align text inside content sections */
        }
        .email-content p {
            margin: 12px 0;
            text-align: center; /* Center-align text inside content sections */

        }
        .email-footer {
            text-align: center;
            padding: 16px;
            font-size: 14px;
            color: #777777;
            border-top: 1px solid #dddddd;
            margin-top: 24px;

        }
        .email-footer p{
            text-align: center;
        }

        .highlight {
            font-weight: bold;
            color: #ff6f00;
            text-align: center; /* Center-align text inside content sections */

        }
        .section-title {
            font-size: 18px;
            color: #ff8c00;
            border-bottom: 2px solid #ff8c00;
            display: inline-block;
            margin-bottom: 12px;
            text-align: center;
        }
        a {
            color: #ff6f00;
            text-decoration: none;
        }
        a:hover {
            color: #ff8c00;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <h1>Reajuste IPC</h1>
        </div>
        
        <!-- Content Section -->
        <div class="email-content">
            <h3 class="section-title">Detalles del Reajuste Anual</h3>

            <p><span class="highlight">Fecha del inico del Contrato/Arriendo:</span> {{ $inicioArriendoFormateada }}</p>
            <p><span class="highlight">Fecha del Reajuste IPC Anual:</span> {{ $fechaConUnAnoMasFormateada }}</p>

            

        </div>
        
        <!-- Footer Section -->
        <div class="email-footer">
            <p>Este es un correo automático enviado dos meses antes del proximo reajuste IPC anual. Por favor, no responda a este mensaje.</p>
            <p>&copy; {{ date('Y') }} - Home Gestion y Inmobiliaria</p>
            <p style="margin: 5px 0;">
                <a href="http://127.0.0.1:8085/" style="color: #007bff; text-decoration: none;">Visita nuestro sistema web</a>
            </p>
        </div>
    </div>
</body>
</html>
