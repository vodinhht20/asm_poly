<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\ScanMail;
use App\Console\Commands\ScanProduct;
use App\Console\Commands\ScanVideo;
use App\Console\Commands\AddNewSemesterEveryYear;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ScanMail::class,
        ScanProduct::class,
       // ScanVideo::class,
        AddNewSemesterEveryYear::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
       // $schedule->command('scan:video')->withoutOverlapping()->everyMinute();
         $schedule->command('scan:mail')->withoutOverlapping()->everyMinute();
        // ->lastDayOfMonth('6:00')->when(function() { // chạy vào 6:00 AM cuối tháng của các tháng kết thúc kỳ học (4,8,12)
           //  $arrMonth = [4,8,12];
            // $monthNow = Carbon::now()->month;
            // return in_array($monthNow,$arrMonth) ? true : false;
        // });
         $schedule->command('scan:product')->withoutOverlapping()->everyMinute();   // moi 1 phut chay 1 lan
        $schedule->command('yearly:update')->withoutOverlapping()->yearly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        // $this->load(__DIR__.'/Commands/Notify');

        require base_path('routes/console.php');
    }
}
