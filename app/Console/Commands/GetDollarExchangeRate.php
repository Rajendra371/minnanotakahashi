<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class GetDollarExchangeRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange:usd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Exchange Rate For USD daily';

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
    $client = new \GuzzleHttp\Client();
    $request = $client->get('http://apilayer.net/api/live?access_key=d82ff69c899c3750b025612cdf4e919d& currencies=NPR&source=USD&format=1');
    $response = $request->getBody()->getContents();
    $data = json_decode($response);
    // $data = {
    //   "success":true,
    //   "terms":"https:\/\/currencylayer.com\/terms",
    //   "privacy":"https:\/\/currencylayer.com\/privacy",
    //   "timestamp":1602175145,
    //   "source":"USD",
    //   "quotes":{
    //     "USDNPR":117.20947 
    //   }
    // }
    // {
    //     "success":false,
    //     "error":{
    //       "code":105,
    //       "info":"Access Restricted - Your current Subscription Plan does not support Source Currency Switching."
    //     }
    //   } 
    if($data->success){
      \DB::table('exchange_rate')->insert(['currency'=>$data->source,'rate'=>$data->quotes->USDNPR,'date'=> Carbon::today()->toDateString()]);
      $this->info('Exchange Rate Set In Database');
    }else{
        $this->info($data->error->info);
    }

    }
}
