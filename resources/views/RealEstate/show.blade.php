<x-guest-layout>
    @include('RealEstate.modules.single-header')
    <main>
        @if($realestate->sliderimages()->count() > 3)
            <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
            <div class="py-20 px-10 bg-custom-gradient-transparent">
                <div
                    x-data="{ realestate: '{{ $realestate->slug }}',
                              slider:null,
                              images: null,
                              count: {{ $realestate->sliderimages()->count() }},
                              loading: true
                            }"
                    x-init="

                        axios.get( route('realestate-sliderimages', { realEstate : realestate }) )
                        .then( data => {
                                images = data.data;
                                $nextTick(() => {
                                 slider = new Swiper('.swiper', {
                                                slidesPerView: 'auto',
                                                spaceBetween: 30,
                                                rewind: true,
                                                pagination: { el: '.swiper-pagination', clickable: true,  type: 'bullets' },
                                                 navigation: {
                                                        nextEl: '.swiper-button-next-custom',
                                                        prevEl: '.swiper-button-prev-custom',
                                                      },
                                                });


                                                loading = false;
                                })

                        });
                     "
                    class="relative">

                    <div class="w-full aspect-video bg-gray-100 bg-opacity-25 animate-pulse" x-show="loading"></div>
                    <template x-if="images !== null">
                        <div class="relative">
                            <div class="swiper-button-prev-custom absolute left-0 top-1/2 text-white w-10 w-20 h-10 z-50 -ml-20 bg-darkblue hidden md:flex items-center justify-center translate-x-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-10">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"/>
                                </svg>
                            </div>
                            <div class="swiper-button-prev-custom absolute right-0 top-1/2 text-white w-20 h-10 z-50 bg-darkblue hidden md:flex items-center justify-center translate-x-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-10">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/>
                                </svg>
                            </div>
                            <div class="swiper w-full aspect-video" x-show="!loading">
                                <div class="swiper-wrapper">
                                    <template x-for="image in images" :key="image.id">
                                        <div class="relative bg-logo bg-opacity-25 swiper-slide w-[80%] flex items-center justify-center">
                                            <a @click="$dispatch('img-modal', {  imgModalSrc: image.url, imgModalDesc: image.alt[window.lang] })" class="cursor-pointer">
                                                <img :src="image.url"
                                                     :srcset="image.srcset?.srcsetString"
                                                     class="object-fit"
                                                     :class="image.width > image.height ? 'min-h-full' : 'min-w-full'"
                                                     :alt="image.alt[window.lang]"
                                                />
                                            </a>

                                            <div class="absolute bottom-0 left-0 m-5 md:m-10 bg-custom-gradient-50 min-w-xl max-w-[75%] transition-all ease-in-out">
                                                <div class="relative p-2 md:p-3">
                                                    <div class="absolute top-0 right-0">
                                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                             viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                                                             fill="currentColor" class="text-white w-8 -mt-1 -mr-1">
                                                         <polygon class="st0" points="480,0 0,0 0,20 480,20 480,500 500,500 500,20 500,0 "/>
                                                    </svg>
                                                    </div>
                                                    <div class="absolute left-0 bottom-0 -mb-1 -ml-1">
                                                        <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                             viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                                                             fill="currentColor" class="text-white w-8">
                                                        <polygon class="st0" points="20,500 500,500 500,480 20,480 20,0 0,0 0,480 0,500 "/>
                                                    </svg>
                                                    </div>
                                                    <h5 x-text="image.alt[window.lang]" class="text-white font-serif text-xl md:text-2xl"></h5>
                                                    <p x-text="image.description[window.lang]" class="leading-tight text-sm md:text-normal text-white line-clamp-2 hover:line-clamp-none"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        @endif
    </main>
</x-guest-layout>
