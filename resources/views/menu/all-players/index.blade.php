@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_user"></span> {{ __('Find players') }}</h3>
<table class="table table-sm table-dark">
    <thead>
        <tr>
            <th colspan="4">{{ __('All characters') }}</th>
        </tr>
        <tr class="bg-dark">
            <th><span aria-hidden="true" class="li_user"></span> {{ __('Name') }}</th>
            <th><span aria-hidden="true" class="li_heart"></span> {{ __('Status') }}</th>
            <th><span aria-hidden="true" class="li_data"></span> {{ __('Rank') }}</th>
            <th><span aria-hidden="true" class="li_banknote"></span> {{ __('Wealth') }}</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($allCharacters as $character)
        <tr>
            <td>
                <b><a href="/profile/{{ $character->name }}">{{ $character->name }}</a></b>
            </td>
            <td>
                {{ $character->life() }}
            </td>
            <td>
                {{ $character->rank() }}
            </td>
            <td>
                {{ $character->wealth() }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@if (count($allCharacters) > 14)
<a href="/all-players?page={{ max(1, (Request::get('page') ?? 1) - 1) }}" class="btn btn-link">Previous (15)</a>
<a href="/all-players?page={{ max(1, (Request::get('page') ?? 1) + 1) }}" class="btn btn-link float-right">Next (15)</a>
@endif
@endsection