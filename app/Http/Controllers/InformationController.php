<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function rule()
    {
        return view('infomations.rule');
    }

    public function policy()
    {
        return view('infomations.policy');
    }
}