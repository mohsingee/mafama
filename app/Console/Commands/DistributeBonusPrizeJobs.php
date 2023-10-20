<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Prize_condition;
use App\OtherCondition;

class DistributeBonusPrizeJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:distributebonusprizejobs';

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
        //
        //for distribute prize to qualified users
     $reminders=Prize_condition::distribute_bonus_prize_jobs();
     $reminders=OtherCondition::distribute_bonus_for_other_jobs();
     
       
        dd($reminders);
    }
}
