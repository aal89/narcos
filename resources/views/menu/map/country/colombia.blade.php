<figure id="mapsvg">
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 420 560" preserveAspectRatio="xMinYMin meet" >
        <image width="420" height="560" xlink:href="/colombia.png" />
        @for ($i = 0; $i < 6; $i++)
            @for ($j = 0; $j < 8; $j++)
                @php
                    $currentTile = $tiles->filter(function($item) use($i, $j) {
                        return $item->tile === $i + $j * 6;
                    })->first();
                @endphp
                <g opacity="{{ isset($currentTile) ? '1' : '0' }}">
                    <a {{ isTileForSale('colombia', $i + $j * 6) ? 'xlink:href=/map/'.($i + $j * 6) : '' }}>
                        <text fill="#000000" x="{{ $i * 70 + 10 }}" y="{{ $j * 70 + 20 }}">Taken by</text>
                        <foreignObject x="{{ $i * 70 + 10 }}" y="{{ $j * 70 + 25 }}" width="50" height="40">
                            <p style="color:#F1C047;" xmlns="http://www.w3.org/1999/xhtml">{{ isset($currentTile) ? $currentTile->character->name : '' }}</p>
                        </foreignObject>
                        <rect x="{{ $i * 70 }}" y="{{ $j * 70 }}" opacity="0.2" fill="#FFFFFF" width="70" height="70"></rect>
                    </a>
                </g>
            @endfor
        @endfor
    </svg>
</figure>
