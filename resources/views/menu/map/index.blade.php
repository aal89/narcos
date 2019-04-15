@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_shop"></span> {{ __('Map') }}</h3>
<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <p>
            Owning property is status symbol along with a business. Setup any lab on the land to produce yourself
            narcotics of all kinds. Sell those kilo's straight away or smuggle them to a country in need. All
            land taken? Try attacking the property or kill the owner.
        </p>
        <p>@include('session.status')</p>
        <p>
            @if ($chosenTile === 'none')
                <strong>Pick a square on the map.</strong>
            @elseif (is_object($chosenTile))
                @include('menu.map.tile.taken', ['character' => $chosenTile])
            @else
                @include('menu.map.tile.new')
            @endif
        <p>

    </div>
    <div class="col-12 col-md-6 col-lg-6">
        @include('menu.map.country.'.(Auth::user()->character->country), ['tiles' => $tiles])
    </div>
</div>
@endsection
