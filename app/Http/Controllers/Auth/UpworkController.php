<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\OAuthable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpworkController extends Controller
{
    private $service;

    public function __construct(OAuthable $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->service->buildAuthUrl();
        exit();
    }

    public function callback(Request $request)
    {
        $this->service->authorize($request->code);
    }
}
