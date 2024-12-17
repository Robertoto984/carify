<?php

namespace App\Http\Controllers;

use App\Enums\LicenseTypes;
use App\Http\Requests\Driver\StoreDriverRequest;
use App\Http\Requests\Driver\updateDriverRequest;
use App\Models\Driver;
use App\Services\Driver\StoreDriverService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function edit($id)
    {
        $row = Driver::findOrFail($id);
        $LicenseTypes = LicenseTypes::values();
        return response()->json([
            'html' => view('drivers.edit', ['row' => $row,'LicenseTypes'=>$LicenseTypes])->render(),
        ]);
    }
     
    public function store(StoreDriverRequest $request)
    {
        try {
            $driversData = $request->validated();
            $this->storeDriverService->storeDrivers($driversData);
            return response()->json(['message'=>'تم إضافة السائقين بنجاح.','redirect'=>route('drivers.index')]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'حدث خطأ أثناء إضافة السائقين:','redirect'=>route('drivers.index')]);

        }
    }
   
    public function update(updateDriverRequest $request,$id)
    {
        try {
            $driversData = $request->validated();
            $this->storeDriverService->updateDrivers($driversData,$id);
            return response()->json(['message'=>'تم تعديل السائق بنجاح.','redirect'=>route('drivers.index')]);
        } catch (\Exception $e) {
            return response()->json(['message'=>'حدث خطأ أثناء تعديل السائق:','redirect'=>route('drivers.index')]);

        }
    }

    public function destroy($id)
    {
        try {
            $ids = Driver::where('id',$id)->delete();
            return response()
            ->json(['message' => 'تم حذف السائق بنجاح','redirect'=>route('drivers.index')]);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function MultiDelete(Request $request)
    {
        try {
             Driver::whereIn('id',(array)$request['ids'])->delete();
            return response()
            ->json(['message' => 'تم حذف السائق بنجاح','redirect'=>route('drivers.index')]);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
