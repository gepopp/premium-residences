<div class="flex flex-wrap">
    @if($realestate->company->logo)
        <div class="p-20 flex justify-center items-center w-full lg:w-1/2 xl:w-1/4 aspect-square relative">

            <div class="absolute top-0 right-0 m-10">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                     fill="currentColor" class="text-darkblue w-10 lg:hidden">
                   <polygon class="st0" points="480,0 0,0 0,20 480,20 480,500 500,500 500,20 500,0 "/>
                </svg>
            </div>
            <div class="absolute left-0 bottom-0 m-10">
                <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                     fill="currentColor" class="text-darkblue w-10">
                    <polygon class="st0" points="20,500 500,500 500,480 20,480 20,0 0,0 0,480 0,500 "/>
                </svg>
            </div>
            @if($realestate->company->url)
                <a href="{{ $realestate->company->url }}" target="_blank">
                    <div class="absolute right-0 bottom-0 m-10 flex flex-col items-center justify-center -mr-1 group" x-data="{ show: false }"
                         x-on:mouseenter="show = true"
                         x-on:mouseleave="show = false">
                        <div class="-rotate-90 mb-16 text-white text-lg tracking-[.5em] text-darkblue">
                            WEBSITE
                        </div>
                        <div class="w-8 h-8 bg-darkblue rounded-full flex justify-center items-center">
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
                    </div>
                </a>
            @endif
            <img src="{{ $realestate->company->logo->url }}" srcset="{{ $realestate->company?->logo?->srcset->srcset_string ?? '' }}" alt="Logo {{ $realestate->company->name }}">
        </div>
    @endif

    <div class="w-full lg:w-1/2 xl:w-1/4 aspect-square bg-custom-gradient relative p-20 flex flex-col justify-center items-center">
        <div class="absolute top-0 right-0 m-10">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                 viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                 fill="currentColor" class="text-white w-10">
                   <polygon class="st0" points="480,0 0,0 0,20 480,20 480,500 500,500 500,20 500,0 "/>
                </svg>
        </div>
        <div class="absolute left-0 bottom-0 m-10 lg:hidden">
            <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                 viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                 fill="currentColor" class="text-white w-10">
                    <polygon class="st0" points="20,500 500,500 500,480 20,480 20,0 0,0 0,480 0,500 "/>
                </svg>
        </div>

        <div>
            <p class="text-4xl font-bold font-serif text-white">{{ $realestate->company->name }}</p>
            <div class="mt-4">
                <a href="mailto:{{ $realestate->company->email }}" class="block text-white text-lg underline">{{ $realestate->company->email }}</a>
                <a href="mailto:{{ $realestate->company->phone }}" class="block text-white text-lg underline">{{ $realestate->company->phone }}</a>
            </div>
        </div>
    </div>


    @forelse( $realestate->contactpersons ?? [] as $contactperson )

        <div class="flex flex-wrap w-full xl:w-1/2">
            <div class="w-full lg:w-1/2 aspect-square bg-white lg:bg-custom-gradient xl:bg-none xl:bg-white relative p-20 flex flex-col justify-center items-center">
                <div class="absolute top-0 right-0 lg:hidden m-10">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                         fill="currentColor" class="text-darkblue lg:text-white xl:text-darkblue w-10">
                   <polygon class="st0" points="480,0 0,0 0,20 480,20 480,500 500,500 500,20 500,0 "/>
                </svg>
                </div>
                <div class="absolute left-0 bottom-0 m-10">
                    <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                         fill="currentColor" class="text-darkblue text-darkblue lg:text-white xl:text-darkblue w-10">
                    <polygon class="st0" points="20,500 500,500 500,480 20,480 20,0 0,0 0,480 0,500 "/>
                </svg>
                </div>
                <div class="w-1/2 aspect-square shrink-0 bg-darkblue rounded-full text-white">
                    @if($contactperson->contactphoto)
                        <img src="{{ $contactperson->contactphoto->url  }}"/>

                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user w-full h-auto p-5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    @endif
                </div>
            </div>

            <div class="w-full lg:w-1/2 aspect-square bg-custom-gradient lg:bg-white lg:max-xl:bg-none xl:bg-custom-gradient relative p-20 flex flex-col justify-center items-center">
                <div class="absolute top-0 right-0 m-10">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                         fill="currentColor" class="text-white lg:text-darkblue xl:text-white w-10">
                   <polygon class="st0" points="480,0 0,0 0,20 480,20 480,500 500,500 500,20 500,0 "/>
                </svg>
                </div>
                <div class="absolute left-0 bottom-0 lg:hidden  m-10">
                    <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                         fill="currentColor" class="text-white text-white lg:text-darkblue xl:text-white w-10">
                    <polygon class="st0" points="20,500 500,500 500,480 20,480 20,0 0,0 0,480 0,500 "/>
                </svg>
                </div>
                <div class="text-white lg:text-darkblue xl:text-white">
                    <p class="text-4xl font-bold font-serif">{{ $contactperson->name }}</p>
                    <div class="mt-4">
                        <a href="mailto:{{ $contactperson->email }}" class="block text-lg underline">{{ $contactperson->email }}</a>
                        <a href="mailto:{{ $contactperson->phone }}" class="block text-lg underline">{{ $contactperson->phone }}</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
    @endforelse

</div>
