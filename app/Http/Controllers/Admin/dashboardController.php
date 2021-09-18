<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function __construct()
    {
        //ACL Users
        $this->middleware('can:Super-user');
    }
    public function index()
    {
        return view('Admin.dashboard');
    }
}
