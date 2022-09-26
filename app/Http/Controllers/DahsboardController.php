<?php

namespace App\Http\Controllers;

use App\Services\BulanService;
use App\Services\Dashboard\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DahsboardController extends Controller
{
    public function index(){
        $dashboard=DashboardService::dashboard(Auth::user()->level_user);
        $bulans=BulanService::bulan();
        return view('content.dashboard',compact('dashboard','bulans'));
    }
}
