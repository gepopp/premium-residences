@if($realestate->objectdescription)
    <div class="px-20 py-36 bg-white">
        <h2 class="text-center text-darkblue font-serif text-3xl font-semibold mb-10">{{ $realestate->objectdescription->title }}</h2>

        <div>
            {!! $realestate->objectdescription->contents !!}
        </div>
    </div>
@endif
