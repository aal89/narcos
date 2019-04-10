@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_user"></span> {{ __('Online players') }}</h3>
<table class="table table-sm table-dark">
    <thead>
        <tr>
            <th colspan="4">{{ __('Online characters in the past 5 minutes') }}</th>
        </tr>
        <tr class="bg-dark">
            <th><span aria-hidden="true" class="li_user"></span> {{ __('Name') }}</th>
            <th><span aria-hidden="true" class="li_data"></span> {{ __('Rank') }}</th>
            <th><span aria-hidden="true" class="li_banknote"></span> {{ __('Wealth') }}</th>
            <th><span aria-hidden="true" class="li_location"></span> {{ __('Whereabouts') }}</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($onlineCharacters as $character)
        <tr>
            <td>
                <b><a href="/profile/{{ $character->name }}">{{ $character->name }}</a></b>
            </td>
            <td>
                {{ $character->rank() }}
            </td>
            <td>
                {{ $character->wealth() }}
            </td>
            <td>
                {!! $character->isHidden() ? '<span class="text-muted">Unknown</span>' : $character->country() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@if (count($onlineCharacters) > 14)
<a href="/online-players?page={{ max(1, (Request::get('page') ?? 1) - 1) }}" class="btn btn-link">Previous (15)</a>
<a href="/online-players?page={{ max(1, (Request::get('page') ?? 1) + 1) }}" class="btn btn-link float-right">Next (15)</a>
@endif
@endsection