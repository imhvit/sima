<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        html {
            background-color: #fff;
            color: #000;
            overflow-x: hidden;
        }
    </style>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <x-inertia::head>
        <title>{{ config('app.name', 'Sima') }}</title>
    </x-inertia::head>
</head>

<body>
    <x-inertia::app />
</body>

</html>