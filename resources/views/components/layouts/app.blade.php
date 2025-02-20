<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'gadjo' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles


    </head>
    <body class="bg-slate-200" >
        @livewire('partials.navbar')
        <main>
            {{ $slot }}
        </main>
        @livewire('partials.footer')

        @livewireScripts

        {{-- From sweet alert --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts />
        
    </body>
</html>
