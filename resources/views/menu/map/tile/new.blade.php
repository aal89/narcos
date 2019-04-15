<strong>Square #{{ basename(Request::path()) }} is up for sale!</strong>
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
                    Price
                </td>
                <td>
                    &euro;50.000,-
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <button class="btn btn-secondary btn-sm" type="submit">Buy</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>