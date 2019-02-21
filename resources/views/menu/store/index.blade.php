@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_tag"></span> {{ __('Store') }}</h3>
<p>
    Traveling can take a lot of time, buying a vehicle can greatly reduce your travel time. When you don't have any
    your travel time is 90 minutes. Whenever you buy a vehicle while you already own one then this vehicle will be sold automatically for you,
    prior buying the new one. Selling back property happens at a 75% rate.
</p>
@if ($errors->has('asset'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first('asset') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form method="POST" action="/store">
@csrf
    <table class="table table-sm table-dark">
        <thead>
            <tr>
                <th colspan="3">{{ __('Store') }}</th>
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
                <td>Saves an additional 30 minutes for a total of 60 minutes travel time.</td>
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
                <td>Saves an additional 15 minutes for a total of 45 minutes travel time.</td>
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
                <td>Saves an additional 10 minutes for a total of 35 minutes travel time.</td>
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
@endsection