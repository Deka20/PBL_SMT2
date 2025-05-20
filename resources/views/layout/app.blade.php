<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Potretine')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .horizontal-modal {
            min-width: 600px;
            max-width: 800px;
            padding: 0;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-white text-black">
    @include('components.menu')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')
</body>

</html>
