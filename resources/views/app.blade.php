<!DOCTYPE html>
<html lang="de" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <meta name="robots" content="index,follow">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/manifest.js') }}" defer></script>
    <script src="{{ mix('js/vendor.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    @include('meta.favicon')
    @inertiaHead
</head>
<body>
@inertia
</body>
</html>
