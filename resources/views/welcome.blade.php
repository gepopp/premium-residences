<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/cc-icon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased container">

<header class="py-3 flex justify-between items-center text-logo font-bold border-b-2 border-logo">
    <a href="{{ route('home') }}">
        <img src="{{ asset('images/residences_logo_grau.svg') }}" class="h-14 w-auto"/>
    </a>
    <nav class="flex space-x-10">
        <a href="#">
            {{ __('home') }}
        </a>
        <a href="#">
            {{ __('news') }}
        </a>
        <a href="#">
            {{ __('magazine') }}
        </a>
        <a href="#">
            {{ __('real estate') }}
        </a>

    </nav>
    <div>
        @if(app()->getLocale() == 'de')
            <a href="{{ language()->back('en') }}">english version</a>
        @else
            <a href="{{ language()->back('de') }}">deutsche version</a>
        @endif
    </div>
</header>
<main class="min-h-screen">

</main>
<footer class="py-3 flex justify-between items-center text-logo font-bold border-t-2 border-logo">
    <div class="flex">
        <div class="pr-5 mr-5 border-r-2 border-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/residences_logo_grau.svg') }}" class="h-14 w-auto"/>
            </a>
        </div>
        <div class="max-w-xl">
            <p>{!! \Illuminate\Support\Facades\Lang::get('app.footernote') !!}</p>
        </div>
    </div>

</footer>
@livewireScripts
</body>
</html>
