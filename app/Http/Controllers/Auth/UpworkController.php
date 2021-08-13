<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UpworkService;
use Illuminate\Http\Request;

class UpworkController extends Controller
{
    public function index(UpworkService $upworkService)
    {
        $upworkService->buildAuthUrl();
    }

    public function callback(Request $request, UpworkService $upworkService)
    {
        $upworkService->authorize($request->code);
    }
}
