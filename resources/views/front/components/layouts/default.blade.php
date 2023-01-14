<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | {{ config('app.name') }}</title>
    @vite('resources/js/front/app.js')

    @method('style')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex flex-col min-h-screen">
        <x-front::layouts.navbar></x-front::layouts.navbar>

        <x-front::layouts.content class="flex-1">
            {{ $slot }}
        </x-front::layouts.content>

        <x-front::layouts.footer></x-front::layouts.footer>
    </div>

    @stack('script')
</body>
</html>