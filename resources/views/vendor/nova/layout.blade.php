<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">
<head>
    <meta name="theme-color" content="#fff">

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width"/>
    <meta name="locale" content="{{ str_replace('_', '-', app()->getLocale()) }}"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">
    <script src="https://kit.fontawesome.com/{{ config('services.font-awesome.kit-id') }}.js" crossorigin="anonymous"></script>

    @if ($styles = \Laravel\Nova\Nova::availableStyles(request()))
    <!-- Tool Styles -->
        @foreach($styles as $asset)
            <link rel="stylesheet" href="{!! $asset->url() !!}">
        @endforeach
    @endif

    <!-- Theme Styles -->
    @foreach(\Laravel\Nova\Nova::themeStyles() as $publicPath)
        <link rel="stylesheet" href="{{ $publicPath }}">
    @endforeach

    <script>
        if (localStorage.novaTheme === 'dark' || (!('novaTheme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="min-w-site text-sm font-medium min-h-full text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-900">
    @inertia
    <div class="relative z-50">
      <div id="notifications" name="notifications"></div>
    </div>
    <div>
      <div id="dropdowns" name="dropdowns"></div>
      <div id="modals" name="modals"></div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('manifest.js', 'vendor/nova') }}"></script>
    <script src="{{ mix('vendor.js', 'vendor/nova') }}"></script>
    <script src="{{ mix('app.js', 'vendor/nova') }}"></script>

    <!-- Build Nova Instance -->
    <script>
        const config = @json(\Laravel\Nova\Nova::jsonVariables(request()));
        window.Nova = createNovaApp(config)
        Nova.countdown()
    </script>

    @if ($scripts = \Laravel\Nova\Nova::availableScripts(request()))
        <!-- Tool Scripts -->
        @foreach ($scripts as $asset)
            <script src="{!! $asset->url() !!}"></script>
        @endforeach
    @endif

    <!-- Start Nova -->
    <script defer>
        Nova.liftOff()
    </script>
</body>
</html>
