@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_truck"></span> {{ __('Narcotics trade') }}</h3>
<p>
    Smuggling narcotics into other countries can be a lucrative business. Buy low and sell high, be sure to ask around for the current drugroute
    (changes every 24hrs). Your rank determines how much kilograms you can carry.
</p>
<p>
    <b>You can carry:</b> {{ $carryCapacity }}kg.
</p>
<table class="table table-sm table-dark">
    <thead>
        <tr>
            <th colspan="4">{{ __('Narcotics') }}</th>
        </tr>
        <tr class="bg-dark">
            <th>{{ __('Name') }}</th>
            <th>{{ __('Price per kg') }}</th>
            <th>{{ __('Trade') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($prices as $narcotic => $price)
        <tr>
            <td>
                <b>{{ ucfirst($narcotic) }}</b>
            </td>
            <td>
                &euro;{{ $price }},-
            </td>
            <td>
                <div class="form-group input-group-sm mb-0">
                    <input form="form-{{ $narcotic }}" id="{{ $narcotic }}" type="number" class="form-control{{ $errors->has($narcotic) ? ' is-invalid' : '' }} w-50" name="{{ $narcotic }}" value="{{ old($narcotic) }}" placeholder="Amount (e.g. 1)" required>
                    @if ($errors->has($narcotic))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first($narcotic) }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td class="cell-fit">
                <form method="POST" action="/narcotics-trade/trade/{{ $narcotic }}" id="form-{{ $narcotic }}">
                    @csrf
                    <button class="btn btn-link" type="submit" name="action" value="buy">Buy</button><button class="btn btn-link" type="submit" name="action" value="sell">Sell</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection