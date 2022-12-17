<?php

return [
    // Get your key from https://console.developers.google.com

    'api_key'   => env('ADDRESS_AUTOCOMPLETE_API_KEY', ''),
    'map_style' => htmlspecialchars_decode(trim( file_get_contents(public_path('map-style.txt')))),
];
