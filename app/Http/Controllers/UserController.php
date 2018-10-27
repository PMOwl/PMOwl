<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function show()
    {
       return redirect('/');
    }

    public function edit()
    {
        return redirect('/');
    }
}
