<?php 


namespace App\Services;

use Upwork\API\Routers\Hr\Jobs;
use Upwork\API\Routers\Jobs\Search;

class UpworkJobsService extends Upwork
{
    private $query;
    private $title;
    private $count = 10;
    private $offset = 0;

    public function getJobs()
    {
        $this->client->auth();
        return (new Search($this->client))->find([
            'q' => $this->query,
            'title' => $this->title,
            'paging' => $this->offset.';'.$this->count,
        ]);
    }

    public function setQuery($q)
    {
        $this->query = $q;
        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }
}