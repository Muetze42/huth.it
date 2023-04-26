<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ $pageTitle }}</title>
    @include('app.og')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow"/>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @inertiaHead
    @include('app.favicon')
</head>
<body>
@inertia
</body>
</html>
