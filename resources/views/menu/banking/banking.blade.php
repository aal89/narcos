@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_banknote"></span> {{ __('Banking') }}</h3>
<p>
    By saving up money in the bank for 24hr you will generate interest over time. You can safely store your money here. Each withdrawal
    or deposit action will reset the (24hr) timer. Interest pay-outs can be delayed by up to 30 mins.
</p>
<p>
    <strong>Your current balance:</strong> &euro;{{ Auth::user()->character->bank->money }},-
    <br>
    <strong>Interest pays:</strong> in {{ Auth::user()->character->bank->hoursSinceLastAction() }} hour(s)
</p>
<div class="w-20 mb-3">
    <form method="POST" action="/banking">
    @csrf
        <div class="input-group input-group-sm mb-1">
            <input id="character" type="number" maxlength="25" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" required>
            @if ($errors->has('amount'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('amount') }}</strong>
                </span>
            @endif
        </div>
        <button class="btn btn-secondary btn-sm" type="submit" name="action" value="deposit">Deposit</button>
        <button class="btn btn-secondary btn-sm" type="submit" name="action" value="withdraw">Withdraw</button>
    </form>
</div>
<table class="table table-sm table-dark">
    <thead>
        <tr>
            <th colspan="2">{{ __('Interest generated per amount per 24hr') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <small>></small> &euro;0,-
            </td>
            <td>
                12%
            </td>
        </tr>
        <tr>
            <td>
                <small>></small> &euro;50.000,-
            </td>
            <td>
                10%
            </td>
        </tr>
        <tr>
            <td>
                <small>></small> &euro;100.000,-
            </td>
            <td>
                9%
            </td>
        </tr>
        <tr>
            <td>
                <small>></small> &euro;250.000,-
            </td>
            <td>
                8%
            </td>
        </tr>
        <tr>
            <td>
                <small>></small> &euro;500.000,-
            </td>
            <td>
                7%
            </td>
        </tr>
        <tr>
            <td>
                <small>></small> &euro;1.000.000,-
            </td>
            <td>
                6%
            </td>
        </tr>
        <tr>
            <td>
                <small>></small> &euro;10.000.000,-
            </td>
            <td>
                2%
            </td>
        </tr>
    </tbody>
</table>
@endsection