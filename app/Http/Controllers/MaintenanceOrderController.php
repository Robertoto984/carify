<?php

namespace App\Http\Controllers;

use App\Traits\CommandNumGen;
use Illuminate\Http\Request;

class MaintenanceOrderController extends Controller
{
    use CommandNumGen;

    public function index()
    {
        return view('maintenance_orders.index');
    }

    public function create()
    {
        return view('maintenance_orders.create');
    }
}
