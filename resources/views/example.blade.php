<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased bg-gray-100">
    <div class="container mx-auto mt-0 p-6 bg-white rounded-lg shadow-2xl">
        <h1 class="text-4xl font-semibold text-gray-900 text-center">Haarlem Festival</h1>
    </div>

    {!! $example_text !!}

</body>
</html>
