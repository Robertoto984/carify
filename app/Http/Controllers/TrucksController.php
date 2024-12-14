<?php

namespace App\Http\Controllers;

use App\Enums\Color;
use App\Enums\FuelTypes;
use App\Http\Requests\Truck\StoreTruckRequest;
use App\Models\Driver;
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
        return view('trucks.index');
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
        $data = $request->validated();

        try {
            $this->addTruckService->store($data);
            return redirect()->route('trucks.index')->with('success', 'تم إضافة المركبة بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'حدث خطأ أثناء إضافة المركبة']);
        }
    }
}
