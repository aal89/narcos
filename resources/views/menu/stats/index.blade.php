@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_star"></span> {{ __('Statistics') }}</h3>
<table class="table table-sm table-dark">
    <thead>
        <tr>
            <th colspan="2">{{ __('Totals and such...') }}</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td class="cell-fit">
                Last registered character
            </td>
            <td>
                <a href="/profile/{{ App\Stats::newestCharacter()->name }}">{{ App\Stats::newestCharacter()->name }}</a>
            </td>
        </tr>
        <tr>
            <td class="cell-fit">
                Highest ranking character
            </td>
            <td>
                <a href="/profile/{{ App\Stats::highestRankingCharacter()->name }}">{{ App\Stats::highestRankingCharacter()->name }}</a> <small>({{ App\Stats::highestRankingCharacter()->rank() }})<small>
            </td>
        </tr>
        <tr>
            <td class="cell-fit">
                Money in-game
            </td>
            <td>
                &euro;{{ number_format(App\Stats::totalMoney(), 0, '.', '.') }},-
            </td>
        </tr>
        <tr>
            <td class="cell-fit">
                Bullets in-game
            </td>
            <td>
                {{ number_format(App\Stats::totalBullets(), 0, '.', '.') }}
            </td>
        </tr>
        <tr>
            <td class="cell-fit">
                Crime attempts
            </td>
            <td>
                {{ number_format(App\Stats::totalCrimeAttempts(), 0, '.', '.') }}
            </td>
        </tr>
        <tr>
            <td class="cell-fit">
                Organized crime attempts
            </td>
            <td>
                {{ number_format(App\Stats::totalOrganizedCrimeAttempts(), 0, '.', '.') }}
            </td>
        </tr>
        <tr>
            <td class="cell-fit">
                Kill attempts (that failed)
            </td>
            <td>
                {{ number_format(App\Stats::totalKillFail(), 0, '.', '.') }}
            </td>
        </tr>
        <tr>
            <td class="cell-fit">
                Kill attempts (that succeeded)
            </td>
            <td>
                {{ number_format(App\Stats::totalKillSuccess(), 0, '.', '.') }}
            </td>
        </tr>
        <tr>
            <td class="cell-fit">
                Money lost at the numbers game
            </td>
            <td>
                &euro;{{ number_format(App\Stats::totalNumbersGameLoss(), 0, '.', '.') }},-
            </td>
        </tr>
        <tr>
            <td class="cell-fit">
                Money lost at the roulette
            </td>
            <td>
                &euro;{{ number_format(App\Stats::totalRouletteLoss(), 0, '.', '.') }},-
            </td>
        </tr>
    </tbody>
</table>
@endsection
