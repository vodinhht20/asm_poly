<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Semester;
use Carbon\Carbon;
class AddNewSemesterEveryYear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yearly:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new semesters every year';

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
     * @return int
     */
    public function handle()
    {
        $semesterList=[
            ['name'=>'Spring'],
            ['name'=>'Summer'],
            ['name'=>'Fall'],
        ];
        $year=Carbon::now()->year;
       
        foreach($semesterList as $item){
            $semester=new Semester();
            $semester->name=$item['name'].' '.$year;
            $semester->save();
        }
    }
}
