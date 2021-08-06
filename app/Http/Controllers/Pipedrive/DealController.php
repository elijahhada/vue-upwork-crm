<?php

namespace App\Http\Controllers\Pipedrive;

use App\Http\Controllers\Controller;
use App\Services\PipedriveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DealController extends Controller
{
    public function add(Request $request)
    {
        try {
            (new PipedriveService())->addDeal([
                'title' => $request->title,
            ]);

            Session::flash('message', 'Deal created successfully!');

            return redirect()->route('dashboard');
        } catch (\Exception $exception) {
            Session::flash('message', 'Deal did not create!');

            return redirect()->route('dashboard');
        }
    }
}
