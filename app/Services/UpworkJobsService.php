<?php 


namespace App\Services;

use Upwork\API\Routers\Hr\Jobs;
use Upwork\API\Routers\Jobs\Search;

class UpworkJobsService extends Upwork
{
    public function getJobs($q)
    {
        $this->client->auth();
        return (new Search($this->client))->find(['q' => $q]);
    }
}