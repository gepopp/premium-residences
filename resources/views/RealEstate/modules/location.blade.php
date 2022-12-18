@if($realestate->locationdescription)

    <div class="lg:hidden bg-darkblue order-first">
        <div class="p-20 relative">
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
            <h2 class="text-white font-serif text-xl lg:text-2xl xl:text-4xl font-bold text-center">{{ $realestate->locationdescription->title }}</h2>
            <div class="text-white text-center mt-10">{!! $realestate->locationdescription->contents !!}</div>
        </div>
    </div>
@endif


<script>
    window.google_key = '{{ config('google-autocomplete.api_key')}}';
    window.google_style = '{!! config('google-autocomplete.map_style') !!}';
</script>
<div x-data="
{    getUrl(){
               return  'https://maps.googleapis.com/maps/api/staticmap?key='
                + window.google_key
                + '&center={{ $realestate->address->lat  }},{{ $realestate->address->long  }}&zoom={{ $realestate->address->zoom }}'
                + '&format=png&maptype=roadmap&style=element:geometry%7Ccolor:0xf5f5f5&style=element:labels.icon%7Cvisibility:off&style=element:labels.text.fill%7Ccolor:0x616161'
                + '&style=element:labels.text.stroke%7Ccolor:0xf5f5f5&style=feature:administrative.land_parcel%7Celement:labels.text.fill%7Ccolor:0xbdbdbd&style=feature:poi%7Celement:geometry%7Ccolor:0xeeeeee'
                + '&style=feature:poi%7Celement:labels.text.fill%7Ccolor:0x757575&style=feature:poi.park%7Celement:geometry%7Ccolor:0xe5e5e5&style=feature:poi.park%7Celement:labels.text.fill%7Ccolor:0x9e9e9e&style=feature:road%7Celement:geometry%7Ccolor:0xffffff'
                + '&style=feature:road.arterial%7Celement:labels.text.fill%7Ccolor:0x757575&style=feature:road.highway%7Celement:geometry%7Ccolor:0xdadada&style=feature:road.highway%7Celement:labels.text.fill%7Ccolor:0x616161&style=feature:road.local%7Celement:labels.text.fill%7Ccolor:0x9e9e9e'
                + '&style=feature:transit.line%7Celement:geometry%7Ccolor:0xe5e5e5&style=feature:transit.station%7Celement:geometry%7Ccolor:0xeeeeee&style=feature:water%7Celement:geometry%7Ccolor:0xc9c9c9&style=feature:water%7Celement:labels.text.fill%7Ccolor:0x9e9e9e&size=640x380&scale=2';
    }

}"
     class="relative aspect-[4/3] lg:aspect-video bg-custom-gradient-gray">
    <img :src="getUrl" class="w-full h-full object-cover"/>

    <div class="absolute top-0 left-0 w-full h-full bg-custom-gradient-75 flex justify-end items-end">

        <a href="http://maps.google.com/?q={{ $realestate->address->lat }},{{ $realestate->address->long }}&z={{ $realestate->address->zoom }}" target="_blank">
            <div class="flex space-x-3 m-10">
                <div class="text-white text-right">
                    <p class="text-lg leading-tight tracking-widest">{!!  $realestate->address->geocoordinates  !!}</p>
                    <p class="text-xs leading-tight">{{ __('view in google maps') }}</p>
                </div>
                <div class="text-white w-20 h-10 z-50 bg-darkblue hidden md:flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/>
                    </svg>
                </div>
            </div>
        </a>
    </div>

    @if($realestate->locationdescription)
        <div class="hidden lg:block absolute top-0 left-0 max-w-xl bg-darkblue ml-5 xl:ml-20 mt-5 xl:mt-20">
            <div class="p-20 relative">
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
                <h2 class="text-white font-serif text-xl lg:text-2xl xl:text-4xl font-bold text-center">{{ $realestate->locationdescription->title }}</h2>
                <div class="text-white text-center mt-10 line-clamp-5">{!! $realestate->locationdescription->contents !!}</div>
            </div>
        </div>
    @endif
</div>
