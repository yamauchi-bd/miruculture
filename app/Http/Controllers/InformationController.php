<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function rule()
    {
        return view('informations.rule');
    }

    public function policy()
    {
        return view('informations.policy');
    }

    public function legal()
    {
        return view('informations.legal');
    }
}
