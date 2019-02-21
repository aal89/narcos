<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Character;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            // todo: optimize this bit, db is normalized into char -> bank. So querying all banks
            // then for each bank decide if it should get any payout. iff thats true, then populate
            // the character and update all columns. Now ALL characters with their banks are queried
            // which is unnecessary since most characters dont have a payout pending.
            Character::all()->each(function ($char) {
                if ($char->bank->money > 0 && $char->bank->hoursSinceLastAction() === 0) {
                    $char->money += $char->bank->moneyWithInterest();
                    $char->save();
                    $char->bank->money = 0;
                    $char->bank->save();
                }
            });
        })->everyThirtyMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
