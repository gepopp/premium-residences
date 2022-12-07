<header class="flex flex-col lg:flex-row">
    <div class="w-full lg:w-1/2 shrink-0 aspect-square bg-custom-gradient relative flex items-center p-20 text-white">
        <div class="absolute top-0 right-0 m-10">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                 viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                 fill="currentColor" class="text-white w-10">
                   <polygon class="st0" points="480,0 0,0 0,20 480,20 480,500 500,500 500,20 500,0 "/>
                </svg>
        </div>
        <div class="absolute left-0 bottom-0 m-10">
            <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                 viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                 fill="currentColor" class="text-white w-10">
                    <polygon class="st0" points="20,500 500,500 500,480 20,480 20,0 0,0 0,480 0,500 "/>
                </svg>
        </div>
        <div class="absolute right-0 bottom-0 m-10 flex flex-col items-center justify-center -mr-1 group" x-data="{ show: false }"
             x-on:mouseenter="show = true"
             x-on:mouseleave="show = false">
            <div class="-rotate-90 mb-12 text-lg tracking-[.5em]">
                SHARE
            </div>
            <div class="w-8 h-8 bg-white rounded-full flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     class="w-8 h-8 feather feather-plus text-[#8693AB] group-hover:rotate-45 transition">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </div>
            <div class="absolute right-full top-0"
                 x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-90">
                <ul>
                    <li>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('real-estate.show', compact('realestate'))  }}" target="_blank" class="hover:underline underline-offset-4">
                            Facebook
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('real-estate.show', compact('realestate'))  }}" target="_blank" class="hover:underline underline-offset-4">
                            LinkedIn
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="flex flex-col space-y-3">
            <h1>{{ $realestate->title }}</h1>
            <p class="subtitle">
                {{ $realestate->area->name }}
                <span class="mx-3">|</span>
                {{ $realestate->category->name }}
            </p>
            <div class="text-sm line-clamp-3 lg:line-clamp-5">
                {!! $realestate->intro !!}
            </div>
        </div>
    </div>
    <div class="w-full lg:w-1/2 shrink-0 aspect-square relative flex items-center order-first lg:order-last">
        <img src="{{ $realestate->titleimage->url }}" srcset="{{ $realestate->titleimage->srcset?->srcset_string }}"
             x-data="{ width : {{ $realestate->titleimage->width }}, height: {{ $realestate->titleimage->height }} }"
             class="object-cover"
             :class="height > width ? 'min-w-full' : 'min-h-full'"
             alt="{{ $realestate->titleimage->alt }}"
        />
    </div>
</header>
