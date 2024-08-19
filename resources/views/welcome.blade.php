<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans">
    <div class="relative bg-gray-900 text-white overflow-hidden">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px] "
            src="https://laravel.com/assets/img/welcome/background.svg" />

        <div class="absolute right-4 top-2 z-10">
            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif
        </div>

        <div
            class="relative h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">


            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="py-10 flex flex-col gap-4">
                    <img src="{{ asset('images/ctvmosca.png') }}" alt="" class="h-14 w-auto mx-auto">
                    <h1 class="text-center text-2xl text-white/90">Copacabana de television S.R.L.</h1>
                </header>

                <main class="">
                    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">

                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-white/70">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
