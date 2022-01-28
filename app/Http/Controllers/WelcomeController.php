<?php

namespace App\Http\Controllers;

use App\Contracts\Video\VideoHosting;
use App\Services\FakeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class WelcomeController extends Controller
{
    public function index(VideoHosting $service){
        return view('welcome', [
            'service' => $service,
            'fakeService' => App::make(FakeService::class)
        ]);
    }
}
