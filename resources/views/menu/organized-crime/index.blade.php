@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_lab"></span> {{ __('Organized crime') }}</h3>
<p>
    The return on organized crime is huge. However, you'll need a team in order to attempt it. A driver, a spotter and you - the robber. The robber
    is the party leader and is the only one who can invite other people and start the job. The robber takes the biggest cut followed by the spotter
    and then the driver. Attempting organized crime has a 6hr cooldown. 
</p>
@include('session.status')
{{-- youre in a party --}}
@if ($party)
    @include('menu.organized-crime.party.in')
{{-- youre not in a party --}}
@else
    @include('menu.organized-crime.party.no')
@endif
@endsection