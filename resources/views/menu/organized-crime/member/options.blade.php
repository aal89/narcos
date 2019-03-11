{{-- to prevent confussion, $position comes from the controller and refers to the position the char has within the party, --}}
{{-- $member is a party position, giving through the 'outer' view in, this is so that we can make distinction between what --}}
{{-- view were looking at --}}

{{-- youre in a party and the robber's view is shown --}}
@if ($party && $member === 'robber')
    <b><a href="/profile/{{ $party->robber->name }}">{{ $party->robber->name }}</a></b> is leader.
{{-- youre in a party, not the leader and the position is open --}}
@elseif ($party && $party->robber->id !== Auth::user()->character->id && $party->$member === null)
    <i>Awaiting invitation.</i>
{{-- youre in a party, not the leader and this is position is you --}}
@elseif ($party && $party->robber->id !== Auth::user()->character->id && $party->$member->id === Auth::user()->character->id)
    <form method="POST" action="/organized-crime/remove">
    @csrf
        <b>You</b>.
        <button class="btn btn-danger btn-sm" type="submit" name="action" value="leave">Leave</button>
    </form>
{{-- youre in a party, the leader, and someones taken this spot --}}
@elseif ($party && $party->robber->id === Auth::user()->character->id && $party->$member !== null)
    <form method="POST" action="/organized-crime/remove">
    @csrf
        <b><a href="/profile/{{ $party->$member->name }}">{{ $party->$member->name }}</a></b> accepted.
        <button class="btn btn-danger btn-sm" type="submit" name="action" value="kick">Kick</button>
    </form>
{{-- youre in a party, not the leader, and someones taken this spot --}}
@elseif ($party && $party->robber->id !== Auth::user()->character->id && $party->$member !== null)
    <b><a href="/profile/{{ $party->$member->name }}">{{ $party->$member->name }}</a></b> accepted.
{{-- youre in a party, the leader, and nobodys taken this spot yet --}}
@elseif ($party && $party->robber->id === Auth::user()->character->id && $party->$member === null)
    <form method="POST" action="/organized-crime/invite/{{ $member }}">
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