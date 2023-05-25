<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index(){
        return view('features.dashboard',[
            'title'=>"Dashboard",
            'pengumuman'=>Pengumuman::all()
        ]);

      
    }
}
