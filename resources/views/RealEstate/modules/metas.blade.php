@if($realestate->metas()->count())
    <div class="bg-white py-20">
        <div class="grid grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6 gap-5 lg:gap-10">
            @foreach($realestate->metas as $meta)
                <div class="metabox aspect-square p-5 relative flex justify-center items-center">
                    <div class="absolute top-0 right-0 m-5">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                             fill="currentColor" class="text-white w-10">
                                <polygon class="st0" points="480,0 0,0 0,20 480,20 480,500 500,500 500,20 500,0 "/>
                        </svg>
                    </div>
                    <div class="absolute left-0 bottom-0 m-5">
                        <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"
                             fill="currentColor" class="text-white w-10">
                                <polygon class="st0" points="20,500 500,500 500,480 20,480 20,0 0,0 0,480 0,500 "/>
                                </svg>
                    </div>
                    <div class="text-center text-white p-0 lg:p-5">
                        @if($meta->number)
                            <p class="text-5xl font-bold font-serif">{{ $meta->number }}</p>
                        @endif
                        <p class="text-lg font-semibold">{{ $meta->text }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
