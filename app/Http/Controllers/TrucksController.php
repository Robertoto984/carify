<?php

namespace App\Http\Controllers;

use App\Enums\Color;
use App\Enums\FuelTypes;
use App\Http\Requests\Truck\StoreTruckRequest;
use App\Models\Driver;
use App\Models\Truck;
use App\Services\Truck\AddTruckService;

class TrucksController extends Controller
{
    protected $addTruckService;

    public function __construct(AddTruckService $addTruckService)
    {
        $this->addTruckService = $addTruckService;
    }

    public function index()
    {
        $trucks = Truck::with('truckDeliverCards.driver')->get();
        return view('trucks.index', compact('trucks'));
    }

    public function create()
    {
        $colors = Color::values();
        $fuelTypes = FuelTypes::values();
        $drivers = Driver::all();
        return view('trucks.create', compact('colors', 'fuelTypes','drivers'));
    }

     public function store(StoreTruckRequest $request)
    {
        try {
            $this->addTruckService->store($request->validated());

            return redirect()->route('trucks.index')->with('success', 'Truck(s) added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
