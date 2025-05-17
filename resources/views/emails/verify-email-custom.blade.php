<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Verifica la tua email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
        }

        h1 {
            color: #d10000;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #d10000;
            color: white !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
        }
    </style>
</head>

<body>

    <h1>Ciao {{ $notifiable->name }},</h1>
    <p>Per favore clicca sul pulsante qui sotto per verificare il tuo indirizzo email.</p>
    <p>
        <a href="{{ $url }}" class="button">
            Verifica Email
        </a>
    </p>
    <p>Se non hai richiesto questa verifica, puoi ignorare questa email.</p>
    <div class="footer">
        <p>Grazie,<br>Il team di Visits Sulmona! ❤</p>
    </div>
</body>

</html>
