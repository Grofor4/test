<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KurirController extends Controller
{
    public function index()
    {
        return view('be.kurir.index');
    }
}