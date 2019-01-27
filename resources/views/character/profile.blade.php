@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_user"></span> {{ $character->name }}</h3>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <table class="table table-sm table-dark">
        <tbody>
            <tr>
                <td class="w-15">
                    <span aria-hidden="true" class="li_heart"></span>
                    <span>{{ __('Health') }}</span>
                </td>
                <td>
                    <span>{{ $character->life }}%</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span aria-hidden="true" class="li_data"></span>
                    <span>{{ __('Rank') }}</span>
                </td>
                <td>
                    <span>{{ $character->rank() }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span aria-hidden="true" class="li_banknote"></span>
                    <span>{{ __('Money') }}</span>
                </td>
                <td>
                    <span>&euro;{{ $character->money() }},-</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span aria-hidden="true" class="li_truck"></span>
                    <span>{{ __('Contraband') }}</span>
                </td>
                <td>
                    <span>{{ $character->contraband() }}kg</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span aria-hidden="true" class="li_location"></span>
                    <span>{{ __('Whereabouts') }}</span>
                </td>
                <td>
                    <span>{{ $character->country() }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span aria-hidden="true" class="li_world"></span>
                    <span>{{ __('Transport') }}</span>
                </td>
                <td>
                    <span>{{ $character->transport() }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    {{ $character->profile->description }}
                </td>
            </tr>
        </tbody>
    </table>
</form>
@endsection
