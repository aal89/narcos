@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_lab"></span> {{ __('Organized crime') }}</h3>
<p>
    The return on organized crime is huge. However, you'll need a team in order to attempt it. A driver, a spotter and you - the robber. The robber
    is the party leader and is the only one who can invite other people and start the job. The robber takes the biggest cut followed by the spotter
    and then the driver. Attempting organized crime has a 6hr cooldown. 
</p>
@include('session.status')
<div class="row">
    <div class="col-sm text-right">
        <h4>The driver</h4>
        <p>Minimum rank required: <b>Low-life</b>. Payout: 20%.</p>
        <div class="w-50 mb-3 float-right">
            <form method="POST" action="/organized-crime/driver">
            @csrf
                <div class="input-group input-group-sm mb-1">
                    <input id="driver" type="text" maxlength="25" class="form-control{{ $errors->has('driver') ? ' is-invalid' : '' }}" name="driver" value="{{ old('driver') }}" placeholder="Character name" required>
                    @if ($errors->has('driver'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('driver') }}</strong>
                        </span>
                    @endif
                </div>
                <button class="btn btn-secondary btn-sm" type="submit" name="action" value="invite">Invite</button>
            </form>
        </div>
    </div>
    <div class="col-sm">
        <h4>The spotter</h4>
        <p>Minimum rank required: <b>Hitman</b>. Payout: 30%.</p>
        <div class="w-50 mb-3">
            @if (false)
            <form method="POST" action="/organized-crime/spotter">
            @csrf
                <div class="input-group input-group-sm mb-1">
                    <input id="spotter" type="text" maxlength="25" class="form-control{{ $errors->has('spotter') ? ' is-invalid' : '' }}" name="spotter" value="{{ old('spotter') }}" placeholder="Character name" required>
                    @if ($errors->has('spotter'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('spotter') }}</strong>
                        </span>
                    @endif
                </div>
                <button class="btn btn-secondary btn-sm" type="submit" name="action" value="invite">Invite</button>
            </form>
            @else
            <form method="POST" action="/organized-crime/spotter/remove">
            @csrf
                <b>speler</b> accepted your invitation.
                <button class="btn btn-danger btn-sm" type="submit" name="action" value="kick">Kick</button>
            </form>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm text-center">
        <h4>The robber</h4>
        <p>Minimum rank required: <b>Lieutenant</b>. Payout: 50%.</p>
        <b>You</b>
    </div>
</div>
<div class="row mt-5">
    <div class="col-sm text-center">
        <button type="button" class="btn btn-primary btn-lg">Attempt</button>
    </div>
</div>
@endsection