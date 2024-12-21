<?php

namespace App\Http\Controllers;


class MovementCommandController extends Controller
{
    public function index()
    {
        return view('commands.index');
    }
    
    public function create()
    {
        return view('commands.create');
    }
}
