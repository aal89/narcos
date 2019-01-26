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
                    <a href="#" class="">Messages (0)</a>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <span aria-hidden="true" class="li_banknote"></span> &euro; {{ number_format(Auth::user()->character->money, 0, '.', '.') }},-
                <span aria-hidden="true" class="li_truck pl-2"></span> {{ number_format(Auth::user()->character->contraband, 0, '.', '.') }}kg
                <span aria-hidden="true" class="li_location pl-2"></span> {{ str_replace('Of', 'of', ucwords(Auth::user()->character->country)) }}
                <span aria-hidden="true" class="li_world pl-2"></span> {{ ucfirst(Auth::user()->character->transport) }}
            </td>
        </tr>
    </tbody>
</table>