<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA Verification</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-950">

<div class="min-h-screen flex items-center justify-center px-4">
    <div class="fi-simple-main my-16 w-full bg-gray-900 px-6 py-12 shadow-sm ring-1 ring-white/10 sm:rounded-xl sm:px-12 max-w-lg text-white">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-semibold text-white">
                Підтвердження входу
            </h1>

            <p class="text-gray-300 text-sm mt-2">
                Введіть 6-значний код, який ми надіслали на email
            </p>
        </div>

        <form method="POST" action="/two-factor" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-white mb-2">
                    Код підтвердження
                </label>

                <input
                    type="text"
                    name="code"
                    maxlength="6"
                    inputmode="numeric"
                    autocomplete="one-time-code"
                    autofocus
                    placeholder="••••••"
                    class="w-full px-4 py-3 text-center text-lg tracking-widest
                           bg-gray-800 border border-gray-700 rounded-xl
                           text-white placeholder-gray-400
                           shadow-sm
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            @if($errors->any())
                <div class="text-red-400 text-sm text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700
                       text-white font-semibold py-3 rounded-xl
                       transition shadow-sm"
            >
                Підтвердити
            </button>
        </form>

        <div class="text-center mt-6 text-xs text-gray-400">
            Якщо код не прийшов — перевірте “Спам” або зачекайте 1–2 хв
        </div>
    </div>
</div>
</body>
</html>
