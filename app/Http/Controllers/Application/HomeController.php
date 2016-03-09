<?php

namespace App\Http\Controllers\Application;

use App\Base\Controllers\ApplicationController;

class HomeController extends ApplicationController
{
    /**
     * Show the application homepage to the user.
     *
     * @return Response
     */
    public function index()
    {
        
        return view('application.home.index');
    }
}
