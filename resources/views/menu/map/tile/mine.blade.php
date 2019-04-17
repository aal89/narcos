<strong>Square #{{ basename(Request::path()) }} is yours.</strong>
<form method="POST" action="/map/edit/{{ basename(Request::path()) }}">
@csrf
    <table class="table table-sm table-dark">
        <thead>
            <tr>
                <th colspan="2">{{ __('Property') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Info</td>
                <td>
                    <span class="not-bold">
                        Every hour the labs on this square produce about half a kilo of drugs of the chosen setup. A maximum
                        of 10kgs can be held at any time. Converting a lab takes about 12hrs to complete. Releasing land will
                        put it up for sale again.
                    </span>
                </td>
            </tr>
            <tr>
                <td class="w-10">Setup</td>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="setup" id="radio1" value="weed" {{ $property->setup === 'weed' ? 'checked' : '' }}>
                        <label class="form-check-label" for="radio1">Weed</label>
                    </div>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="setup" id="radio2" value="lsd" {{ $property->setup === 'lsd' ? 'checked' : '' }}>
                        <label class="form-check-label" for="radio2">Lsd</label>
                    </div>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="setup" id="radio3" value="speed" {{ $property->setup === 'speed' ? 'checked' : '' }}>
                        <label class="form-check-label" for="radio3">Speed</label>
                    </div>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="setup" id="radio4" value="cocaine" {{ $property->setup === 'cocaine' ? 'checked' : '' }}>
                        <label class="form-check-label" for="radio4">Cocaine</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Yield</td>
                <td class="not-bold">{{ $property->yield() }}kg</td>
            </tr>
            <tr>
                <td>In production</td>
                <td>{!! $property->inProduction() ? '<font color=green>Yes</font>' : '<font color=red>No</font>' !!}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <button class="btn btn-secondary btn-sm" type="submit" name="action" value="collect">Collect</button>
                    <button class="btn btn-secondary btn-sm" type="submit" name="action" value="convert">Convert</button>
                    <button class="btn btn-danger btn-sm float-right" type="submit" name="action" value="release">Release</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>