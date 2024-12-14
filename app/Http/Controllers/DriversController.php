<?php

namespace App\Http\Controllers;

use App\Enums\LicenseTypes;
use App\Http\Requests\Driver\StoreDriverRequest;
use App\Models\Driver;
use App\Services\Driver\StoreDriverService;

class DriversController extends Controller
{
    protected $storeDriverService;

    public function __construct(StoreDriverService $storeDriverService)
    {
        $this->storeDriverService = $storeDriverService;
    }

    public function index()
    {
        $drivers = Driver::with('trucks')->get();
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        $LicenseTypes = LicenseTypes::values();

        return view('drivers.create', compact('LicenseTypes'));
    }
     
    public function store(StoreDriverRequest $request)
    {
        $this->storeDriverService->storeDrivers($request->all());

        return redirect()->route('drivers.index')->with('success', 'تم إضافة سائق بنجاح');
    }
}
