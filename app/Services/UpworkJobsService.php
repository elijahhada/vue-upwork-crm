<?php 


namespace App\Services;

use Upwork\API\Routers\Hr\Jobs;
use Upwork\API\Routers\Jobs\Search;

class UpworkJobsService extends Upwork
{
    public function getJobs()
    {
        $this->client->auth();
        return (new Search($this->client))->find(['q' => 'laravel']);
    }
}