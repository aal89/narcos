@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_banknote"></span> {{ __('Banking') }}</h3>
<p>
    By saving up money in the bank for 24hr you will generate interest over time. You can safely store your money here. Each withdrawal
    or deposit action will reset the (24hr) timer. Interest pay-outs can be delayed by up to 30 mins.
</p>
<p>
    Using the bank you can also transfer money between players. This money is transfered from your on-hand cash and the bank takes a 10%
    fee.
</p>
@include('session.status')
<div class="row">
    <div class="col-sm">
        <p>
            <strong>Your current balance:</strong> &euro;{{ Auth::user()->character->bank->money }},-
            <br>
            <strong>Interest pays in:</strong> {{ Auth::user()->character->bank->hoursSinceLastAction() }} hour(s)
        </p>
        <div class="w-50 mb-3">
            <form method="POST" action="/banking">
            @csrf
                <div class="input-group input-group-sm mb-1">
                    <input id="character" type="number" maxlength="25" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" placeholder="Amount (e.g. 100)" required>
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
    </div>
    <div class="col-sm">
        <p>
            <strong>Transfer</strong>
        </p>
        <div class="w-50 mb-3">
            <form method="POST" action="/banking">
            @csrf
                <div class="input-group input-group-sm mb-1">
                    <input id="character" type="text" maxlength="25" class="form-control{{ $errors->has('transfer_to') ? ' is-invalid' : '' }}" name="transfer_to" value="{{ old('transfer_to') }}" placeholder="To (character name)" required>
                    @if ($errors->has('transfer_to'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('transfer_to') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group input-group-sm mb-1">
                    <input id="character" type="number" maxlength="25" class="form-control{{ $errors->has('transfer_amount') ? ' is-invalid' : '' }}" name="transfer_amount" min="100" value="{{ old('transfer_amount') }}" placeholder="Amount (e.g. 100)" required>
                    @if ($errors->has('transfer_amount'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('transfer_amount') }}</strong>
                        </span>
                    @endif
                </div>
                <button class="btn btn-secondary btn-sm" type="submit" name="action" value="transfer">Transfer</button>
            </form>
        </div>
    </div>
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