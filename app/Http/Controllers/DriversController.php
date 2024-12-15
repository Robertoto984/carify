<?php

namespace App\Http\Controllers;

use App\Enums\LicenseTypes;
use App\Http\Requests\Driver\StoreDriverRequest;
use App\Models\Driver;
use App\Services\Driver\StoreDriverService;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    protected $storeDriverService;

    public function __construct(StoreDriverService $storeDriverService)
    {
        $this->storeDriverService = $storeDriverService;
    }

    public function index()
    {
        $drivers = Driver::with('truckDeliverCards.truck')->get();
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        $LicenseTypes = LicenseTypes::values();

        return view('drivers.create', compact('LicenseTypes'));
    }
     
    public function store(StoreDriverRequest $request)
    {
        try {
            $driversData = $request->validated();
            $this->storeDriverService->storeDrivers($driversData);

            return redirect()->route('drivers.index')->with('success', 'تم إضافة السائقين بنجاح.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة السائقين: ' . $e->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        $driverIds = $request->input('drivers');
        if (Driver::whereIn('id', $driverIds)->delete()) {
            return redirect()->route('drivers.index')->with('success', 'تم حذف السائقين بنجاح.');
        } else {
            return redirect()->route('drivers.index')->with('error', 'حدث خطأ في عملية الحذف');
        }
    }

}
