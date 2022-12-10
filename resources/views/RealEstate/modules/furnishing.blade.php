@if(is_null($realestate->metadescription) && is_null($realestate->featuresimage) && $realestate->features->count())
    <div class="p-20 bg-custom-gradient">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            @foreach($realestate->features as $feature)
                <div class="flex items-center space-x-3 mb-10 md:mb-0 text-white text-xl">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <p>
                        {{ $feature->feature }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

@endif

@if($realestate->metadescription || ( $realestate->featuresimage && $realestate->features->count() ))
    <div class="bg-darkblue flex flex-col md:flex-row">
        <div @class([
            "w-full relative",
            "md:w-2/3 lg:aspect-square" => $realestate->features->count(),
            "lg:aspect-video" => !$realestate->features->count()
            ]) >
            @if($realestate->featuresimage)
                <div class="absolute top-0 left-0 w-full h-full">
                    <img src="{{ $realestate->featuresimage->url }}" class="min-h-full object-cover">
                </div>
            @endif
            @if($realestate->metadescription)
                <div class="w-full h-full flex justify-center items-center">
                    <div class="bg-custom-gradient-90 z-50 p-5 md:p-0 xl:p-20 ">
                        <div @class([
                               "relative flex items-center",
                               "lg:aspect-square" => $realestate->features->count(),
                               "lg:aspect-video" => !$realestate->features->count()
                               ]) >
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
                            <div class="p-20">
                                <h2 class="text-white font-serif text-xl lg:text-2xl xl:text-4xl font-bold text-center">{{ $realestate->metadescription->title }}</h2>
                                <div class="text-white text-center mt-10">{!! $realestate->metadescription->contents !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if($realestate->features->count())
            <div class="w-full md:w-1/3 bg-custom-gradient-75 min-h-full">
                <ul class="flex flex-col justify-between h-full px-10 py-20 text-white text-lg">
                    @foreach($realestate->features as $feature)
                        <li class="flex items-center space-x-3 mb-10 md:mb-0">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                            <p>
                                {{ $feature->feature }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endif
