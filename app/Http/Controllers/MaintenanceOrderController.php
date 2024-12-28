<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceOrder;
use App\Traits\CommandNumGen;
use Illuminate\Http\Request;

class MaintenanceOrderController extends Controller
{
    use CommandNumGen;

    public function index()
    {
        if (request()->user()->cannot('index', MaintenanceOrder::class)) {
            abort(403);
        }
        return view('maintenance_orders.index');
    }

    public function create()
    {
        if (request()->user()->cannot('create', MaintenanceOrder::class)) {
            abort(403);
        }
        return view('maintenance_orders.create');
    }
}
