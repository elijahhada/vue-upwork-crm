<?php

namespace App\Http\Controllers\Pipedrive;

use App\Contracts\OAuthable;
use App\Http\Controllers\Controller;
use App\Services\PipedriveAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DealController extends Controller
{
    public function add(Request $request, OAuthable $service)
    {
        try {
            $service->addDeal([
                'title' => 'test title test title',
            ]);
            dd('ok');
//            (new PipedriveAuthService())->addDeal([
//                'title' => 'test title test title',
//            ]);
            Session::flash('message', 'Deal created successfully!');
            return redirect()->route('dashboard');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            Session::flash('message', 'Deal did not create!');
            return redirect()->route('dashboard');
        }
    }
}
