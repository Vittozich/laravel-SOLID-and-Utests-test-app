<?php

namespace App\Http\Controllers\Tests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrowserTestController extends Controller
{
    public function feedback(){

        return view('feedback');
    }
}
