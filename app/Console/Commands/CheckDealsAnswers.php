<?php

namespace App\Console\Commands;

use App\Models\Bid;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class CheckDealsAnswers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deals:answers';

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
     * @return int
     */
    public function handle()
    {
        $client = new Client();
        $bids = Bid::where('has_answer', '!=', true)->pluck('title', 'id');
        $bids = $bids->toArray();
        $bidsIdsToUpdate = [];
        $flag = true;
        $count = 0;
        $offset = 0;
        $limit = 500;
        while($flag) {
            $query = [
                'api_token' => config('pipedrive.api_token'),
                'start' => $offset,
                'limit' => $limit,
                'stage_id' => 2
            ];
            $response = $client->request('GET', 'https://vasterra.pipedrive.com/api/v1/deals', ['query' => $query])
                ->getBody()
                ->getContents();
            $response = json_decode($response, true);
            $offset = $offset + 500;
            if(!empty($response['data'])) {
                foreach ($response['data'] as $deal) {
                    $count++;
                    echo $deal['title'] . PHP_EOL;
                    echo $count . PHP_EOL;
                    foreach ($bids as $key => $title) {
                        if($deal['title'] === $title) {
                            array_push($bidsIdsToUpdate, $key);
                        }
                    }
                }
            }
            if(empty($response['data'])) {
                $flag = false;
            }
        }
        Bid::whereIn('id', $bidsIdsToUpdate)->update(['has_answer' => true]);
        var_dump('done!');
        return 0;
    }
}
