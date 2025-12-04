<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
{
    return redirect('http://localhost:3000/user/dashboard');
}

}
