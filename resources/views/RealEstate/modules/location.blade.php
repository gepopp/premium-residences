<div class="relative aspect-video bg-custom-gradient-gray">
    <div class="absolute top-0 right-0 m-10 relative">
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
    <div class="absolute top-0 left-0 max-w-2xl bg-darkblue">
        <div class="p-20">
            <h2 class="text-white font-serif text-xl lg:text-2xl xl:text-4xl font-bold text-center">{{ $realestate->metadescription->title }}</h2>
            <div class="text-white text-center mt-10">{!! $realestate->metadescription->contents !!}</div>
        </div>
    </div>
</div>
