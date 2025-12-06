<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index(Request $request) {
        return 'Home page, source: '.$request->sourceUrl;
    }
}
