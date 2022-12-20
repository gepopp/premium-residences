<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/cc-icon.svg') }}">
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script>
        window.lang = '{{ app()->getLocale() }}';
    </script>

</head>
<body class="antialiased container">
<div x-data="{ imgModal : false, imgModalSrc : '', imgModalDesc : '', open(event){ this.imgModal = true; this.imgModalSrc = event.detail.imgModalSrc; this.imgModalDesc = event.detail.imgModalDesc; } }">
    <div @img-modal.window="open" x-show="imgModal">
        <div x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-90"
             x-on:click.away="imgModalSrc = ''"
             class="p-2 fixed w-full h-100 inset-0 z-[9999] overflow-hidden flex justify-center items-center bg-custom-gradient">
            <div @click.away="imgModal = ''" class="flex flex-col max-w-full max-h-full overflow-auto">
                <div class="z-50">
                    <button @click="imgModal = ''" class="float-right pt-2 pr-2 outline-none focus:outline-none">
                        <svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="p-2">
                    <img :alt="imgModalSrc" class="object-contain h-1/2-screen" :src="imgModalSrc"/>
                    <p x-text="imgModalDesc" class="text-center text-white"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<header class="relative py-3 flex justify-between items-center text-logo font-bold border-b-2 border-logo">

    <div class="hidden md:block">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/residences_logo_grau.svg') }}" class="h-14 w-auto"/>
        </a>
    </div>
    <div class="md:hidden pl-3">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/cc-icon.svg') }}" class="h-14 w-auto"/>
        </a>
    </div>


    <nav class="hidden sm:flex space-x-10">
        <a href="{{ route('home') }}">
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
    <div class="hidden sm:block">
        @if(app()->getLocale() == 'de')
            <a href="{{ language()->back('en') }}">english</a>
        @else
            <a href="{{ language()->back('de') }}">deutsch</a>
        @endif
    </div>

    <div x-data="{ show: false }" class="sm:hidden">
        <div class="pr-3 flex space-x-3 items-center justify-center">

            @if(app()->getLocale() == 'de')
                <a href="{{ language()->back('en') }}">en</a>
            @else
                <a href="{{ language()->back('de') }}">de</a>
            @endif

            <div x-on:click="show = !show" class="cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </div>
        </div>

        <div x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90"
             x-on:click.outside="show = false"
             class="absolute left-0 top-full w-full bg-white p-5 z-50 sm:hidden border-b-2 border-logo">
            <nav class="flex flex-col space-y-10">
                <a href="{{ route('home') }}" class="text-xl">
                    {{ __('home') }}
                </a>
                <a href="#" class="text-xl">
                    {{ __('news') }}
                </a>
                <a href="#" class="text-xl">
                    {{ __('magazine') }}
                </a>
                <a href="#" class="text-xl">
                    {{ __('real estate') }}
                </a>
            </nav>
        </div>
    </div>
</header>
<main class="min-h-screen">
    {{ $slot ?? '' }}
</main>
<footer class="mt-20 py-3 flex justify-between items-center text-logo font-bold border-t-2 border-logo">
    <div class="flex">
        <div class="pr-5 mr-5 border-r-2 border-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/residences_logo_grau.svg') }}" class="h-14 w-auto"/>
            </a>
        </div>
        <div class="max-w-xl">
            <p>{!! __('app.footernote') !!}</p>
        </div>
    </div>

</footer>

@env(['local', 'development'])
    <div class="fixed bottom-0 right-0 text-5xl p-10">
        <p class="sm:hidden">xs</p>
        <p class="hidden sm:block md:hidden">sm</p>
        <p class="hidden md:block lg:hidden">md</p>
        <p class="hidden lg:block xl:hidden">lg</p>
        <p class="hidden xl:block 2xl:hidden">xl</p>
        <p class="hidden 2xl:block">2xl</p>
    </div>
@endenv
@livewireScripts
</body>
</html>
