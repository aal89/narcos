{{-- youre in a party, not the leader and this is not you --}}
@if (false)
    <i>Awaiting invitation.</i>
{{-- youre in a party, not the leader and this is you --}}
@elseif (false)
    <form method="POST" action="/organized-crime/{{ $member }}/remove">
    @csrf
        <b>You</b>.
        <button class="btn btn-danger btn-sm" type="submit" name="action" value="leave">Leave</button>
    </form>
{{-- youre in a party, the leader, and someones taken this spot --}}
@elseif (false)
    <form method="POST" action="/organized-crime/{{ $member }}/remove">
    @csrf
        <b>Someone else</b>.
        <button class="btn btn-danger btn-sm" type="submit" name="action" value="kick">Kick</button>
    </form>
{{-- youre in a party, the leader, and nobodys taken this spot yet --}}
@elseif (false)
    <form method="POST" action="/organized-crime/{{ $member }}">
    @csrf
        <div class="input-group input-group-sm mb-1">
            <input id="{{ $member }}" type="text" maxlength="25" class="form-control{{ $errors->has($member) ? ' is-invalid' : '' }}" name="{{ $member }}" value="{{ old($member) }}" placeholder="Character name" required>
            @if ($errors->has($member))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first($member) }}</strong>
                </span>
            @endif
        </div>
        <button class="btn btn-secondary btn-sm" type="submit" name="action" value="invite">Invite</button>
    </form>
@endif