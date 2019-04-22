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
                <h5 class="text-secondary" id="profile">Character</h5>
            </div>
            <div class="row">
                <p>
                    Char.
                </p>
            </div>
            <div class="row">
                <h5 class="text-secondary" id="profile">Banking</h5>
            </div>
            <div class="row">
                <p>
                    You could use the bank to hide your wealth status for others. As a nice side-effect this will also generate you money. Interest is paid out
                    using the following table.
                </p>
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th colspan="2">{{ __('Interest generated per amount per 24hr') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <small>></small> &euro;0,-
                            </td>
                            <td>
                                12%
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small>></small> &euro;50.000,-
                            </td>
                            <td>
                                10%
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small>></small> &euro;100.000,-
                            </td>
                            <td>
                                9%
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small>></small> &euro;250.000,-
                            </td>
                            <td>
                                8%
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small>></small> &euro;500.000,-
                            </td>
                            <td>
                                7%
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small>></small> &euro;1.000.000,-
                            </td>
                            <td>
                                6%
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small>></small> &euro;10.000.000,-
                            </td>
                            <td>
                                2%
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                            <td><p class="text-center not-bold mb-0">Some text</p></td>
                        </tr>
                        <tr>
                            <td>:br:</td>
                            <td><i class="not-bold">*An empty line*</i></td>
                        </tr>
                        <tr>
                            <td>:link:<font color=red>https://www.google.com</font>:-link:<font color=red>Google</font>:/link:</td>
                            <td><a class="not-bold" href="https://www.google.com">Google</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <h5 class="text-secondary" id="profile">Crime</h5>
            </div>
            <div class="row">
                <p>
                    Both trivial crimes and organized crimes are the only ways for you to rank up your character. Buying/selling dope, killing someone,
                    buying property, banking, traveling or gambling are not going to level up your character. Throughout your career as a drugdealer
                    these types or crimes are increasingly important. Never give up leveling up your character. We use the experience count in the game
                    for various aspects.
                </p>
                <p>
                    The payout, experience wise, for trivial crimes are proportional to the succession rate. What this means is that we take the
                    succession rate and use it as a multiplier for the experience given on an attempt. Consider the next example.
                </p>
                <p>
                    <img class="img-fluid mb-2" src="/crime-exp.png" />
                </p>
                <p>
                    In the screenshot you can see the first crime having a succession rate of 23%, the second 11% and the last one 5%. For each succesful
                    attempt you generate <code>x</code> amount of experience, this is then multiplied by your succession rate as a decimal with a minimum of 0.2.
                    So the first crime attempt would result in a calculation like: <code>x * 0.23</code>. The second and the third are equivalent to:
                    <code>x * 0.2</code>. The maximum success rate is 95%.
                </p>
                <p>
                    There are three (trivial) crimes to do. The first one is leveled up three times quicker than the last one. The second one is leveled up twice
                    the speed of the last one. The money payouts are propotional in the same fashion.
                </p>
            </div>
            <div class="row">
                <h5 class="text-secondary" id="profile">Killing</h5>
            </div>
            <div class="row">
                <p>
                    Killing is a serious business, so the technical implementation is serious too. Once a character is dead it is no longer
                    playable.
                </p>
                <p>
                    In the code we keep track of a characters experience count. We use it to display someones rank and to determine how 'strong'
                    this character is. To determine how many bullets you need to kill someone we use this formula:
                    <code>8998 + (196 - 8998) / (1 + ($exp / 707677) ^ 0.5319177)</code>.
                    The <code>$exp</code> is replaced with the targets experience count. This results in a graph like this:
                </p>
                <p>
                    <img class="img-fluid mb-2" src="/bullets-curve.png" />
                    <i>Note: each red dot is rank, 1 million exp (x-axis) is required to get to rank <b>Kingpin</b></i>. The y-axis is the
                    number of bullets required.
                </p>
                <p>
                    This graph has a certain number of properties. Firstly you build up defenses really quick, and the old veterans who have been
                    playing for years are not immortal.
                </p>
                <p>
                    The number from the equation is not final. More factors come into play. Each bullet fired at a target has up to 10% chance
                    to shatter or not fire at all. Then the weapon used to fire these bullets introduces another factor. The only weapon to maximise
                    bullet damage is the <b>M-16</b>, it's effectiveness is about 100%. The graph drawn above is plotted with the <b>M-16</b> in mind.
                    Bullet damage is implicit and this number is different for different weapons.
                </p>
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th colspan="2">{{ __('Weapon effectiveness') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Glock</td>
                            <td>70% - 80%</td>
                        </tr>
                        <tr>
                            <td>Shotgun</td>
                            <td>
                                80% - 90%
                            </td>
                        </tr>
                        <tr>
                            <td>Ak-47</td>
                            <td>90% - 100%</td>
                        </tr>
                        <tr>
                            <td>M-16</td>
                            <td>100%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <h5 class="text-secondary" id="profile">Map</h5>
            </div>
            <div class="row">
                <p>
                    Todo.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
