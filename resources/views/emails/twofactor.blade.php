<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>2FA Code</title>
</head>
<body style="margin:0; padding:0; background:#f3f4f6; font-family: Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
    <tr>
        <td align="center">
            <table width="480" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:12px; padding:40px;">
                <tr>
                    <td align="center" style="font-size:22px; font-weight:700; color:#111827;">
                        🔐 Підтвердження входу
                    </td>
                </tr>

                <tr>
                    <td style="padding-top:20px; font-size:14px; color:#6b7280; text-align:center;">
                        Привіт 👋<br><br>
                        Ми отримали запит на вхід в адмін-панель.
                    </td>
                </tr>

                <tr>
                    <td align="center" style="padding:30px 0;">
                        <div style="
                            display:inline-block;
                            font-size:32px;
                            letter-spacing:8px;
                            font-weight:700;
                            background:#f3f4f6;
                            padding:14px 28px;
                            border-radius:10px;
                            color:#111827;
                        ">
                            {{ $code }}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="font-size:14px; color:#6b7280; text-align:center;">
                        ⏱ Код дійсний <b>10 хвилин</b>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top:20px; font-size:13px; color:#9ca3af; text-align:center;">
                        Якщо це були не ви — просто ігноруйте цей лист.
                    </td>
                </tr>

                <tr>
                    <td style="padding-top:30px; font-size:13px; color:#111827; text-align:center;">
                        Дякуємо,<br>
                        <b>{{ config('app.name') }}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
