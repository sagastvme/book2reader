<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8" />

        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script>
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark')
            }
        </script>

        <style>

            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles
        @vite('resources/css/app.css')
    </head>

    <body class="antialiased bg-white dark:bg-gray-900">
        {{ $slot }}

        @livewire('notifications')

        @filamentScripts
        @vite('resources/js/app.js')
    <footer class="prose dark:prose-invert prose-gray max-w-none">
        Created by <x-filament::link target="_blank" icon-position="after" icon="heroicon-m-sparkles" :href="'https://github.com/sagastvme/book2reader'">
            Sagastvme
        </x-filament::link>
        Powered by Koa, Kepubify, KindleGen and pdfCropMargins
        Source code on Github - https://books.supralynx.com/
        Last updated: 2024-10-20
        Buy me a coffee
        Custom software for your company: supralynx.com
        curl -H "Accept: application/vnd.github+json" https://api.github.com/repos/sagastvme/book2reader

    </footer>
    </body>
</html>
