@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_banknote"></span> {{ __('Banking') }}</h3>
<p>
    By saving up money in the bank for 24hr you will generate interest. Each withdrawal or deposit action will reset the
    (24hr) timer. Interest pay-outs can be delayed by up to 30 mins.
</p>
<p>
    Using the bank you can also transfer money between players. This money is transfered from your on-hand cash and the bank takes a 10%
    fee.
</p>
@include('session.status')
<div class="row">
    <div class="col-sm">
        <!-- <p>
            <strong>Your current balance:</strong> &euro;{{ Auth::user()->character->bank->money }},-
            <br>
            <strong>Interest pays in:</strong> {{ Auth::user()->character->bank->hoursSinceLastAction() }} hour(s)
        </p> -->
        <div class="mb-3">
            <form method="POST" action="/banking">
                @csrf
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th colspan="2">{{ __('Bank') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="cell-fit">Interest pays in</td>
                            <td> {{ Auth::user()->character->bank->hoursSinceLastAction() }} hour(s)</td>
                        </tr>
                        <tr>
                            <td class="cell-fit">Your current balance</td>
                            <td>&euro;{{ Auth::user()->character->bank->money }},-</td>
                        </tr>
                        <tr>
                            <td class="cell-fit">Amount</td>
                            <td>
                                <div class="input-group input-group-sm mb-1">
                                    <input id="character" type="number" maxlength="25" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" placeholder="Amount (e.g. 100)" required>
                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-secondary btn-sm" type="submit" name="action" value="deposit">Deposit</button>
                                <button class="btn btn-secondary btn-sm" type="submit" name="action" value="withdraw">Withdraw</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <form method="POST" action="/banking">
            @csrf
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th colspan="2">{{ __('Transfer') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="cell-fit">To</td>
                            <td>
                                <div class="input-group input-group-sm mb-1">
                                    <input id="character" type="text" maxlength="25" class="form-control{{ $errors->has('transfer_to') ? ' is-invalid' : '' }}" name="transfer_to" value="{{ old('transfer_to') }}" placeholder="To (character name)" required>
                                    @if ($errors->has('transfer_to'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('transfer_to') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="cell-fit">Amount</td>
                            <td>
                                <div class="input-group input-group-sm mb-1">
                                    <input id="character" type="number" maxlength="25" class="form-control{{ $errors->has('transfer_amount') ? ' is-invalid' : '' }}" name="transfer_amount" min="100" value="{{ old('transfer_amount') }}" placeholder="Amount (e.g. 100)" required>
                                    @if ($errors->has('transfer_amount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('transfer_amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-secondary btn-sm" type="submit" name="action" value="transfer">Transfer</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection