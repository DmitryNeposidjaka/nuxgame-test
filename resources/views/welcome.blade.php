<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center px-4">

<main class="w-full max-w-md">
    <div class="bg-white rounded-2xl shadow-lg p-8">

        <h1 class="text-2xl font-semibold text-gray-900 mb-2">
            Register
        </h1>

        <p class="text-sm text-gray-500 mb-6">
            Enter your username and phone number to continue.
        </p>

        @include('partials.register-form')

        @if (session('registration_link'))
            <div class="mt-6">
                @include('partials.registration-result', [
                    'registrationLink' => session('registration_link'),
                ])
            </div>
        @endif

    </div>
</main>

</body>
</html>
