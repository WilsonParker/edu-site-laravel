<?php

namespace App\Console;

use App\Console\Commands\EnsureQueueListenerIsRunning;
use App\Library\LaravelSupports\app\Database\Command\Migrations\CreateMigrateMakeCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Tests\Unit\APITest;

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
        /**
         * queue 가 실행중인지 체크하고 queue 가 종료 됐을 경우 재시작합니다.
         */
        // $schedule->command(EnsureQueueListenerIsRunning::class)->hourly()->sendOutputTo('schedule_daily.txt', true);
        // * * * * * cd /Users/mac68/Development/Laravel/edu-site-laravel && /usr/local/bin/php artisan schedule:run >> /Users/mac68/Development/Laravel/edu-site-laravel/storage/logs/schedule-log.txt 2>&1
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
