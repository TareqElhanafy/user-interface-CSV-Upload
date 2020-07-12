<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCsvUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
public $file;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $file)
    {
        $this->file=$file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $databaseData=array_map('str_getcsv',file($this->file));

        foreach($databaseData as $row){
            $a='@';
            $hash='#';
            $indexOFa=stripos($row[0],$a);
            $indexOFhash=stripos($row[1],$hash);
        User::updateOrCreate([
            'client_name'=>substr($row[0],0,$indexOFa),
            'client_id'=>substr($row[0],$indexOFa +1),
            'deal_name'=>substr($row[1],0,$indexOFhash),
            'deal_id'=>substr($row[1],$indexOFhash+1),
            'date'=>$row[2],
            'accepted'=>$row[3],
            'refused'=>$row[4],

        ]);
   
        }
        unlink($this->file);
     
    }
}
