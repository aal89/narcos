<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Cache;

use App\Character;
use App\OrganizedCrime;

use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    private $oneDayInMinutes = 3600;
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

        $schedule->call(function () {
            OrganizedCrime::all()->each(function ($oc) {
                // kill every inactive party
                if (Carbon::parse($oc->updated_at)->diffInMinutes(Carbon::now()) > 60) {
                    $oc->delete();
                }
            });
        })->everyThirtyMinutes();

        $schedule->call(function () {
            $bulletsAndCost = generateBulletsAndCost();
            $bullets = $bulletsAndCost[0];
            $cost = $bulletsAndCost[1];
            // todo: this section should be based on cache locks, therefore we should
            // switch over to memcached or redis to make use of such locking, for now
            // ordinary hacking in cache with possibilities for race conditions
            // use something like this:
            // Cache::lock('daily-bullets-quantity')->get(function () {
            //     Cache::put('daily-bullets-quantity', $bullets, $this->oneDayInMinutes);
            // });
            // Cache::lock('daily-bullets-cost')->get(function () {
            //     Cache::put('daily-bullets-cost', $cost, $this->oneDayInMinutes);
            // });
            Cache::put('daily-bullets-quantity', $bullets, $this->oneDayInMinutes);
            Cache::put('daily-bullets-cost', $cost, $this->oneDayInMinutes);
        })->dailyAt('12:00');

        // Daily at 6 in the morning randomize the drugroute
        $schedule->call(function () {
            Cache::put('contraband-prices', generateContrabandPrices(), $this->oneDayInMinutes);
        })->dailyAt('6:00');
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
