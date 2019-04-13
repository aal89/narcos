@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_shop"></span> {{ __('Map') }}</h3>
@include('session.status')
<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <p>
            Owning property is status symbol along with a business. Setup any lab on the land to produce yourself
            narcotics of all kinds. Sell those kilo's straight away or smuggle them to a country in need. Buying property
            sets you back &euro;50.000,-. All squares taken? Killing the owner will free up that space again.
        </p>
        <p>
            <strong>Pick a square on the map.</strong>
        <p>
        <p>
            {{ isset($country) ? $country : '' }}
            {{ isset($tile) ? $tile : '' }}
        </p>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        @include('menu.map.country.'.(Auth::user()->character->country))
    </div>
</div>
@endsection
