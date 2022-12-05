<x-guest-layout>
    <a href="{{ route('real-estate.show', \App\Models\RealEstate::first()) }}">{{ \App\Models\RealEstate::first()->title }}</a>
</x-guest-layout>
