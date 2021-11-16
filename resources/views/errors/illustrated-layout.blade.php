<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @php $pageMeta['og_title'] = $__env->yieldContent('code').' - '.$__env->yieldContent('title') @endphp
        <title>@yield('title')</title>@include('public.layouts.meta', $pageMeta)<link href="{{ mix('/css/error-pages.css') }}" rel="stylesheet">
    </head>
    <body class="antialiased font-sans">
        <div class="md:flex min-h-screen">
            <div class="w-full md:w-1/2 bg-white flex items-center justify-center">
                <div class="max-w-sm m-8">
                    <div class="text-black text-5xl md:text-15xl font-black">
                        @yield('code', __('Oh no'))
                    </div>

                    <div class="w-16 h-1 bg-purple-light my-3 md:my-6"></div>

                    <p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal">
                        @yield('message')
                    </p>
                    <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">
                        <button class="bg-transparent text-grey-darkest font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg">
                            {{ __('Go Home') }}
                        </button>
                    </a>
                </div>
            </div>
            <div class="relative pb-full md:flex md:pb-0 md:min-h-screen w-full md:w-1/2">
                <div style="background-image: url({{ asset('img/'.errorImage($__env->yieldContent('code'))) }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
                </div>
            </div>
        </div>
    </body>
</html>
