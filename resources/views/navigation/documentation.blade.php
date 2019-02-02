@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-9">
            <h3 class="page-title"><span aria-hidden="true" class="li_note"></span> {{ __('Documentation') }}</h3>
            <div class="container">
            <div class="row">
                <h5 class="text-secondary">All things technical</h5>
            </div>
            <div class="row">
                <p>All calculations, additions and substractions regarding your character and the game are described in more detail on this page. However you cannot derive any rights from this page. They are merely meant as informative. You could use it to determine a strategy.</p>
            </div>
            <div class="row">
                <h5 class="text-secondary" id="profile">Profile</h5>
            </div>
            <div class="row">
                <p>
                    Editing your profile description is easy. Just open your own profile and edit it at the bottom of the page. You can also use <b>NarcoScript</b> to make your profile stand out.
                </p>
                <p>
                    In this chapter you will learn about all the <b>NarcoScript</b> tags, how to use them and what effect they have. At the end of this section there are some examples that you can use.
                </p>
                <p><i>The parts in red are to be filled in by you. All other (white) parts are called the NarcoScript tags and can't be changed. They should be used as noted.</i></p>
                <table class="table table-sm table-dark">
                    <thead>
                        <th colspan="2">NarcoScript tags</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="w-50">:b:<font color=red>Bold text</font>:/b:</td>
                            <td><b>Bold text</b></td>
                        </tr>
                        <tr>
                            <td>:img:<font color=red>https://via.placeholder.com/30</font>:/img:</td>
                            <td><img src="https://via.placeholder.com/30" /></td>
                        </tr>
                        <tr>
                            <td>:img-center:<font color=red>https://via.placeholder.com/30</font>:/img-center:</td>
                            <td><img class="mx-auto d-block" src="https://via.placeholder.com/30" /></td>
                        </tr>
                        <tr>
                            <td>:center:<font color=red>Some text</font>:/center:</td>
                            <td><p class="text-center mb-0">Some text</p></td>
                        </tr>
                        <tr>
                            <td>:br:</td>
                            <td><br><i>*An empty line*</i></td>
                        </tr>
                        <tr>
                            <td>:link:<font color=red>https://www.google.com</font>:-link:<font color=red>Google</font>:/link:</td>
                            <td><a href="https://www.google.com">Google</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <h5 class="text-secondary">etc</h5>
            </div>
            <div class="row">
                <p>TODO</p>
            </div>
        </div>
    </div>
</div>
@endsection
