<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Bonus_condition;

class ClientBonusIncomeReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:clientbonusincomereminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // for user stroke time point update
       // $reminders=Bonus_condition::update_user_point_jobs();

        //for distribute level income
     $reminders=Bonus_condition::distribute_bonus_level_one_income_jobs();
     $reminders=Bonus_condition::distribute_bonus_level_two_income_jobs();
     $reminders=Bonus_condition::distribute_bonus_level_three_income_jobs();
     $reminders=Bonus_condition::distribute_bonus_level_four_income_jobs();
       
        dd($reminders);
    }
}
