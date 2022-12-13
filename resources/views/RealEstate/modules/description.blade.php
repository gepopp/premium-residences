@if($realestate->objectdescription)
    <div class="px-5 sm:px-20 py-36 bg-white flex flex-col items-center">
        <h2 class="text-center text-darkblue font-serif text-3xl font-semibold mb-10 max-w-3xl">{{ $realestate->objectdescription->title }}</h2>

        <div>
            {!! $realestate->objectdescription->contents !!}
        </div>
    </div>
@endif
