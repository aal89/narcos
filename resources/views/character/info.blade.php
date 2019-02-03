<table class="table table-sm table-dark">
    <tbody>
        <tr>
            <td>
                <span>
                    <span aria-hidden="true" class="li_user"></span> 
                    <a href="/profile/{{ Auth::user()->character->name }}" class="">{{ Auth::user()->character->name }}</a>
                    <br>
                    <span aria-hidden="true" class="li_heart"></span> {{ Auth::user()->character->life }}%
                    <span aria-hidden="true" class="li_data pl-2"></span> {{ Auth::user()->character->rank() }}
                </span>
                <span class="float-right">
                    <span aria-hidden="true" class="li_stack"></span>
                    <a href="/messages/inbox" class="">Messages ({{ App\Message::countUnread(Auth::user()->character) }})</a>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <span aria-hidden="true" class="li_banknote"></span> &euro;{{ Auth::user()->character->money() }},-
                <span aria-hidden="true" class="li_truck pl-2"></span> {{ Auth::user()->character->contraband() }}kg
                <span aria-hidden="true" class="li_location pl-2"></span> {{ Auth::user()->character->country() }}
                <span aria-hidden="true" class="li_world pl-2"></span> {{ Auth::user()->character->transport() }}
            </td>
        </tr>
    </tbody>
</table>