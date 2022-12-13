@if(is_array($realestate->video_data))

    <div class="w-full aspect-video bg-darkblue">

        @if($realestate->video_data['type'] == 'youtube')
            <iframe class="w-full aspect-video" src="https://www.youtube.com/embed/{{ $realestate->video_data['id'] }}"
                    title="{{ $realestate->title }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        @elseif($realestate->video_data['type'] == 'vimeo')
           {!! \Illuminate\Support\Str::replace('height="828"', 'height="auto"', $realestate->video_data['data']['html']) !!}
        @else
            <video controls width="100%" height="auto" muted>
                <source src="{{ $realestate->video_data['url'] }}" type="video/mp4">
            </video>
        @endif


    </div>
@endif
