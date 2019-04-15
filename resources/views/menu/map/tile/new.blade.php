<strong>Square #{{ basename(Request::path()) }} is up for sale!</strong>

<form method="POST" action="/map/{{ basename(Request::path()) }}">
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
                    <label for="character" class="col-form-label">Recipient</label>
                </td>
                <td>
                    <div class="col-md-8 col-lg-6">
                        hello
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="subject" class="col-form-label">Subject</label>
                </td>
                <td>
                    <div class="col-md-8 col-lg-6">
                        world
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="message" class="col-form-label">Message</label>
                </td>
                <td>
                    <div class="col-md-12 col-lg-12">
                        buy
                    </div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <div class="col-md-12 col-lg-12">
                        <button class="btn btn-secondary float-right" type="submit">Send</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</form>