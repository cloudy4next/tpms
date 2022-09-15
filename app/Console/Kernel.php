<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\EDIGenerate::class,
        Commands\GenerateCsv::class,
        Commands\UpdateReminderDate::class,
        Commands\UpdateGoogleCallender::class,
        Commands\HomeReport::class,
        Commands\SftpFile::class,
        Commands\SessionReminderCommand::class,
        // Commands\ProviderReminder::class,
        Commands\GenerateKPI::class,
        Commands\GenerateUnreadEmail::class,


    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        //        $schedule->call(function (){
        //            route('demo.send');
        //        })->everyMinute();
        $schedule->command('quote:daily')->everyMinute();
        $schedule->command('quote:downloadcsv')->everyMinute();
        $schedule->command('quote:updatereminder')->everyMinute();
        $schedule->command('quote:updatecallender')->everyMinute();
        $schedule->command('quote:homereport')->everyMinute();
        // $schedule->command('quote:providerreminder')->daily();
        //        $schedule->command('quote:remind')->dailyAt('03:00')->timezone('EST');
        $schedule->command('quote:sftp')->dailyAt('04:00')->timezone('EST');
        $schedule->command('quote:downloadkpi')->everyMinute();
        $schedule->command('quote:unreadMail')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
