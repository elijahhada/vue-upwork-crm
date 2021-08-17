<?php

namespace App\Services\Upwork;

use App\Services\Upwork;
use Upwork\API\Routers\Metadata;

class UpworkMetadataService extends Upwork 
{
    public function getCategories($offset, $size)
    {
        $this->client->auth();

        return (new Metadata($this->client))->getCategoriesV2($offset.';'.$size);
    }
}