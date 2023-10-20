<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\SendReminderEmails;
use App\Console\Commands\SendWithReminderEmails;
use App\Console\Commands\PopupReminderMail;
use App\Console\Commands\ClientManagementSend;
use App\Console\Commands\ClientManagementReminder;
use App\Console\Commands\ClientManagementCard;
use App\Console\Commands\ClientManagementCardReminder;
use App\Console\Commands\ClientManagementVideo;
use App\Console\Commands\ClientManagementVideoReminder;
use App\Console\Commands\ScheduleBirthdayReminder;
use App\Console\Commands\ScheduleBirthdayCardReminder;
use App\Console\Commands\ScheduleBirthdayVideoReminder;
use App\Console\Commands\ScheduleHolidayReminder;
use App\Console\Commands\ScheduleHolidayCardReminder;
use App\Console\Commands\ScheduleHolidayVideoReminder;
use App\Console\Commands\SendEmailOn;
use App\Console\Commands\SendEmailReminder;
use App\Console\Commands\SendCardOn;
use App\Console\Commands\SendCardReminder;
use App\Console\Commands\SendVideoOn;
use App\Console\Commands\SendVideoReminder;
use App\Console\Commands\SendSmsOn;
use App\Console\Commands\SendSmsReminder;
use App\Console\Commands\ScheduleForUserPointUpdate;
use App\Console\Commands\ClientBonusIncomeReminder;
use App\Console\Commands\AffiliatePointUpdater;
use App\Console\Commands\LeadMovedToAffiliateBasketJobs;
use App\Console\Commands\BasketRotationJobs;
use App\Console\Commands\PlanReminder;
use App\Console\Commands\PlanExpired;
use App\Console\Commands\DistributeBonusPrizeJobs;
use App\Console\Commands\AffiliatePromotionJobs;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendReminderEmails::class,
        SendWithReminderEmails::class,
        PopupReminderMail::class,
        ClientManagementSend::class,
        ClientManagementReminder::class,
        ClientManagementCard::class,
        ClientManagementCardReminder::class,
        ClientManagementVideo::class,
        ClientManagementVideoReminder::class,
        ScheduleBirthdayReminder::class,
        ScheduleBirthdayCardReminder::class,
        ScheduleBirthdayVideoReminder::class,
        ScheduleHolidayReminder::class,
        ScheduleHolidayCardReminder::class,
        ScheduleHolidayVideoReminder::class,
        SendEmailOn::class,
        SendEmailReminder::class,
        SendCardOn::class,
        SendCardReminder::class,
        SendVideoOn::class,
        SendVideoReminder::class,
        SendSmsOn::class,
        SendSmsReminder::class,
       
        ClientBonusIncomeReminder::class,
        AffiliatePointUpdater::class,
        LeadMovedToAffiliateBasketJobs::class,
        BasketRotationJobs::class,
        DistributeBonusPrizeJobs::class,
        PlanReminder::class,
        PlanExpired::class,
        AffiliatePromotionJobs::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('reminder:emails')->everyMinute();
        $schedule->command('reminder:reminderemail')->everyMinute();
        $schedule->command('reminder:popup')->everyMinute();
        $schedule->command('reminder:client')->everyMinute();
        $schedule->command('reminder:clientreminder')->everyMinute();
        $schedule->command('reminder:clientcard')->everyMinute();
        $schedule->command('reminder:clientcardreminder')->everyMinute();
        $schedule->command('reminder:clientvideo')->everyMinute();
        $schedule->command('reminder:clientvideoreminder')->everyMinute();
        $schedule->command('reminder:birthday')->dailyAt('10:00');
        $schedule->command('reminder:birthdaycard')->dailyAt('10:00');
        $schedule->command('reminder:birthdayvideo')->dailyAt('10:00');
        $schedule->command('reminder:holiday')->dailyAt('10:00');
        $schedule->command('reminder:holidaycard')->dailyAt('10:00');
        $schedule->command('reminder:holidayvideo')->dailyAt('10:00');
        $schedule->command('reminder:sendemail')->everyMinute();
        $schedule->command('reminder:sendemailreminder')->everyMinute();
        $schedule->command('reminder:sendcard')->everyMinute();
        $schedule->command('reminder:sendcardreminder')->everyMinute();
        $schedule->command('reminder:sendvideo')->everyMinute();
        $schedule->command('reminder:sendvideoreminder')->everyMinute();
        $schedule->command('reminder:sendsms')->everyMinute();
        $schedule->command('reminder:sendsmsreminder')->everyMinute();
         $schedule->command('reminder:leadmovedtoaffiliatebasketjobs')->daily();
        $schedule->command('reminder:affiliatepointupdater')->everyMinute();
      
        $schedule->command('reminder:clientbonusincomereminder')->daily();

        $schedule->command('reminder:distributebonusprizejobs')->daily();
        $schedule->command('reminder:basketrotaionjobs')->daily();

        $schedule->command('reminder:planreminder')->daily();
        $schedule->command('reminder:planexpired')->everyMinute();

        // for user promotions
        $schedule->command('reminder:affiliatepromotionjobs')->everyMinute();
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
