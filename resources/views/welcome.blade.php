<x-guest-layout>
    <ul>
        @foreach(\App\Models\RealEstate::public()->get() as $realestate)
            <li>
                <a href="{{ route('real-estate.show', $realestate) }}">{{ $realestate->title }}</a>
            </li>
        @endforeach
    </ul>

</x-guest-layout>
