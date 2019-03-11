<div class="row">
    <div class="col-sm text-right">
        <h4>The driver</h4>
        <p>Minimum rank required: <b>Low-life</b>. Payout: 20%.</p>
        <div class="w-50 mb-3 float-right">
            <form method="POST" action="/organized-crime/invite/driver">
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
            <form method="POST" action="/organized-crime/invite/spotter">
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
