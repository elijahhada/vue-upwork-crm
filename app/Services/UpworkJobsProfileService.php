<?php


namespace App\Services;


use Upwork\API\Routers\Jobs\Profile;

class UpworkJobsProfileService extends Upwork
{
    public function getJobProfiles($id)
    {
        $this->client->auth();

        return (new Profile($this->client))->getSpecific($id);
    }
}
