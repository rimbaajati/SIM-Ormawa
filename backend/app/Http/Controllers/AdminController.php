<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proposal;

class AdminController extends Controller
{
    public function index(){
      $proposals = Proposal::with('user')->get();

      return view('admin.index', compact('proposal'));
    }
}