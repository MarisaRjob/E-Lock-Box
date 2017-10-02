<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;

class ManagerController extends Controller
{
    //
    public function getHome() {
//        echo 'manager page';
//        return null;
        return view('layouts.dashboard');
    }
}
