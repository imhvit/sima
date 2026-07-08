<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        html {
            background-color: var(--color-background);
            color: var(--color-foreground);
            overflow-x: hidden;
        }

        html.dark {
            background-color: var(--color-background);
            color: var(--color-foreground);
            overflow-x: hidden;
        }
    </style>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">

    @vite(['resources/css/app.css', 'resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
    @routes
    <x-inertia::head>
        <title>{{ config('app.name', 'Sima') }}</title>
    </x-inertia::head>
</head>

<body>
    <x-inertia::app />
</body>

</html>