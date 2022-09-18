<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    {{ Vite::useBuildDirectory('/coffeeAssets') }}
    <meta charset="UTF-8">
    <title>Support</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow"/>
    @vite(['resources/scss/coffee/page.scss'])
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/c/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('c/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('c/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('c/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('c/favicon/safari-pinned-tab.svg') }}" color="#ff0000">
    <link rel="shortcut icon" href="{{ asset('c/favicon/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#ededed">
    <meta name="msapplication-config" content="{{ asset('c/favicon/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<div class="content">
    <h1>Support Your Developer</h1>

    <a href="https://paypal.me/MuetzeOfficial" target="_blank" title="Send Money via PayPal.me">
        <img src="https://www.paypalobjects.com/webstatic/de_DE/i/de-pp-logo-200px.png" alt="PayPal.me">
    </a>
    <a href="https://www.buymeacoffee.com/normanhuth" target="_blank">
        <img src="https://www.buymeacoffee.com/assets/img/guidelines/download-assets-sm-3.svg" alt="Buy me a coffee" width="200">
    </a>
    <a href="https://www.amazon.de/hz/wishlist/ls/1QKQCWT4C5DHU?ref_=wl_share" target="_blank">
        <img src="/assets/wishlist.png" alt="Amazon wishlist" width="200">
    </a>
</div>
<div class="content">
    <h2>Advertising links</h2>
    <a href="https://www.netcup.de/?ref=177959" target="_blank">
        <img src="https://www.netcup.de/static/assets/images/promotion/netcup-setC-234x60.png" alt="Netcup GmbH">
    </a>
    <a href="https://all-inkl.com/PA77D721D085F2D" target="_blank">
        <img src="{{ asset('assets/all-inkl.jpg') }}" alt="ALL-INKL.COM - Webhosting Server Hosting Domain Provider">
    </a>
    <a href="https://www.shoop.de/invite/lqur4UDSln/" target="_blank">
        Shoop Cashback
    </a>
    <a href="https://de.igraal.com/einladung?werber=AG_5a1ab979a2ff2" target="_blank">
        <img src="https://st-de-filebanking.igstatic.com/front/banner/28.gif" alt="iGraal Cashback">
    </a>
</div>
</body>
</html>
