<figure id="mapsvg">
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 420 560" preserveAspectRatio="xMinYMin meet" >
        <image width="420" height="560" xlink:href="/colombia.png" />
        @for ($i = 0; $i < 6; $i++)
            @for ($j = 0; $j < 8; $j++)
                <g opacity="0">
                    <a xlink:href="/map/colombia/{{ $i + $j * 6 }}">
                        <rect x="{{ $i * 70 }}" y="{{ $j * 70 }}" opacity="0.2" fill="#FFFFFF" width="70" height="70"></rect>
                    </a>
                </g>
            @endfor
        @endfor
    </svg>
</figure>
