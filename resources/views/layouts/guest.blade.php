<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {!! seo() !!}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

    </head>
    <body class="font-sans antialiased text-slate-800">
        
        <div class="min-h-screen bg-gradient-to-b from-blue-violet-50/75 to-blue-violet-200 relative z-0">
            @include('partials.header')
            <!-- Page Content -->
            
            <main>
                {{ $slot }}
            </main>

            <img class="absolute bottom-0 start-0 h-auto w-full" src="{{ asset('/img/white_curve.svg') }}" alt="wavy background">
        </div>
        @include('partials.footer')
    </body>
</html>