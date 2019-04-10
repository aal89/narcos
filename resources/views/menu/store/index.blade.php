@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_tag"></span> {{ __('Store') }}</h3>
<p>
    Traveling can take a lot of time, buying a vehicle can greatly reduce your travel time. When you don't have any
    your travel time is 90 minutes. Whenever you buy a vehicle while you already own one then this vehicle will be sold automatically for you,
    prior buying the new one. Selling back property happens at a 75% rate.
</p>
@include('session.status')
<form method="POST" action="/store/transport">
@csrf
    <table class="table table-sm table-dark">
        <thead>
            <tr>
                <th colspan="3">{{ __('Transport') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="asset" id="radio1" value="motor" checked>
                        <label class="form-check-label" for="radio1">
                            Motor
                        </label>
                    </div>
                </td>
                <td>&euro;1.200,-</td>
                <td>Saves an additional 10 minutes for a total of 80 minutes travel time.</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="asset" id="radio2" value="boat">
                        <label class="form-check-label" for="radio2">
                            Boat
                        </label>
                    </div>
                </td>
                <td>&euro;24.000,-</td>
                <td>Saves an additional 15 minutes for a total of 65 minutes travel time.</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="asset" id="radio3" value="plane">
                        <label class="form-check-label" for="radio3">
                            Plane
                        </label>
                    </div>
                </td>
                <td>&euro;105.000,-</td>
                <td>Saves an additional 30 minutes for a total of 35 minutes travel time.</td>
            </tr>
            <tr>
                <td colspan="3">
                    <button class="btn btn-secondary" type="submit" name="action" value="buy">Buy</button>
                    <button class="btn btn-secondary" type="submit" name="action" value="sell">Sell</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>
<p>
    The more expensive your weapon the more damage you can do to your opponents. Choose wisely. Buying and selling principles of vehicles
    also apply here.
</p>
<form method="POST" action="/store/weaponry">
@csrf
    <table class="table table-sm table-dark">
        <thead>
            <tr>
                <th colspan="2">{{ __('Weaponry') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="weapon" id="radio4" value="glock" checked>
                        <label class="form-check-label" for="radio4">
                            Glock
                        </label>
                    </div>
                </td>
                <td>&euro;4.000,-</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="weapon" id="radio5" value="shotgun">
                        <label class="form-check-label" for="radio5">
                            Shotgun
                        </label>
                    </div>
                </td>
                <td>&euro;10.000,-</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="weapon" id="radio6" value="ak-47">
                        <label class="form-check-label" for="radio6">
                            Ak-47
                        </label>
                    </div>
                </td>
                <td>&euro;35.000,-</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="weapon" id="radio7" value="m-16">
                        <label class="form-check-label" for="radio7">
                            M-16
                        </label>
                    </div>
                </td>
                <td>&euro;75.000,-</td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-secondary" type="submit" name="action" value="buy">Buy</button>
                    <button class="btn btn-secondary" type="submit" name="action" value="sell">Sell</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>
<p>
    Each saturday around 11:00 a random amount of bullets are produced by the bulletfactories and put up for sale. They are expensive and hard to
    come by. Buy them while you can.
</p>
<form method="POST" action="/store/bullets">
@csrf
    <table class="table table-sm table-dark">
        <thead>
            <tr>
                <th colspan="2">{{ __('Bullets') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    Currently in stock: {{ $bulletQuantity }} bullets.<br>
                    Sold for: &euro;{{ $bulletCost }},- a piece.
                </td>
            </tr>
            <tr>
                <td>
                    <label for="amount" class="col-form-label">{{ __('Amount') }}</label>
                </td>
                <td>
                    <div class="input-group input-group-sm mb-1 w-50">
                        <input id="amount" type="number" maxlength="25" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" placeholder="Amount (e.g. 100)" required>
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
                    <button class="btn btn-secondary" type="submit" name="action" value="buy">Buy</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>
<p>
    Hire a bunch of look-a-like's to mask your actual location, useful in situations where you are being hunted. The look-a-like's
    scatter and stop working for you randomly. Takes about 24hrs for your location to get visible again.
</p>
<form method="POST" action="/store/hide">
@csrf
    <table class="table table-sm table-dark">
        <thead>
            <tr>
                <th colspan="2">{{ __('Hide') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    Cost: &euro;100.000,-
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-secondary" type="submit" name="action" value="hide" {{ Auth::user()->character->isHidden() ? 'disabled' : '' }}>Hire look-a-like's</button><br>
                    <small>{{ Auth::user()->character->isHidden() ? 'Your location is currently unknown to others.' : '' }}</small>
                </td>
            </tr>
        </tbody>
    </table>
</form>
@endsection