<strong>Square #{{ basename(Request::path()) }} is under control by <a href="/profile/{{ $property->character->name }}">{{ $property->character->name }}</a>!</strong>
<form method="POST" action="/map/buy/{{ basename(Request::path()) }}">
@csrf
    <table class="table table-sm table-dark">
        <thead>
            <tr>
                <th colspan="2">{{ __('Property') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="w-10">
                    Bullets
                </td>
                <td>
                    input
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <button class="btn btn-danger btn-sm" type="submit">Attack</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>