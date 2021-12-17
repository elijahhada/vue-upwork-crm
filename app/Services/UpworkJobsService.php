<?php

namespace App\Services;

use Upwork\API\Routers\Jobs\Profile;
use Upwork\API\Routers\Jobs\Search;

class UpworkJobsService extends Upwork
{
    private $query;
    private $title;
    private $count = 10;
    private $offset = 0;
    private $category2;
    private $subcategory2;
    private $days_posted;

    public function __construct()
    {
        parent::__construct();
        $this->client->auth();
    }

    public function getJobs()
    {
        return (new Search($this->client))->find([
            'q' => $this->query,
            'title' => $this->title,
            'paging' => $this->offset . ';' . $this->count,
            'category2' => $this->category2,
            'subcategory2' => $this->subcategory2,
            'days_posted' => $this->days_posted,
        ]);
    }

    public function getJobProfiles($id)
    {
        return (new Profile($this->client))->getSpecific($id);
    }

    public function setDatePosted($days)
    {
        $this->days_posted = $days;
        return $this;
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
        if ($count) {
            $this->count = $count;
        }

        return $this;
    }

    public function setOffset($offset)
    {
        if ($offset) {
            $this->offset = $offset;
        }

        return $this;
    }

    public function setCategory2($category2)
    {
        if ($category2) {
            $this->category2 = $category2;
        }

        return $this;
    }

    public function setSubcategory2($subcategory2)
    {
        if ($subcategory2) {
            $this->subcategory2 = $subcategory2;
        }

        return $this;
    }
}
