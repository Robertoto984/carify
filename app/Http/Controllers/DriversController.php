<?php

namespace App\Http\Controllers;

use App\Enums\LicenseTypes;
use App\Exports\DriversExport;
use App\Http\Requests\Driver\StoreDriverRequest;
use App\Http\Requests\Driver\updateDriverRequest;
use App\Imports\DriversImport;
use App\Models\Driver;
use App\Services\Driver\StoreDriverService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DriversController extends Controller
{
    protected $storeDriverService;

    public function __construct(StoreDriverService $storeDriverService)
    {
        $this->storeDriverService = $storeDriverService;
    }

    public function index()
    {
        if (request()->user()->cannot('index', Driver::class)) {
            abort(403);
        }

        $drivers = Driver::with('truckDeliverCards.truck')->get();
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        if (request()->user()->cannot('create', Driver::class)) {
            abort(403);
        }
        $LicenseTypes = LicenseTypes::values();

        return view('drivers.create', compact('LicenseTypes'));
    }

    public function edit($id)
    {
        $driver = new Driver();
        if (request()->user()->cannot('update', $driver)) {
            abort(403);
        }

        $row = Driver::findOrFail($id);
        $LicenseTypes = LicenseTypes::values();
        return response()->json([
            'html' => view('drivers.edit',[
                'row' => $row,
                'LicenseTypes' => $LicenseTypes
                ])->render(),
        ]);
    }

    public function store(StoreDriverRequest $request)
    {

        try {
            if (request()->user()->cannot('create', Driver::class)) {
                abort(403);
            }
    
            $driversData = $request->validated();
            $this->storeDriverService->storeDrivers($driversData);
            return response()->json([
                'message' => 'تم إضافة السائقين بنجاح.', 
                'redirect' => route('drivers.index')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'حدث خطأ أثناء إضافة المرافق.',
                'error' => $e->getMessage(),
                'redirect' => route('drivers.index')
            ], 500);

        }
    }

    public function update(updateDriverRequest $request, $id)
    {
        try {
            $driver = new Driver();
            if (request()->user()->cannot('update', $driver)) {
                abort(403);
            }
    
            $driversData = $request->validated();
            $this->storeDriverService->updateDrivers($driversData, $id);
            return response()->json([
                'message' => 'تم تعديل السائق بنجاح.', 
                'redirect' => route('drivers.index')
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'حدث خطأ أثناء تعديل السائق:', 'redirect' => route('drivers.index')]);

        }
    }

    public function destroy($id)
    {
        try {
            $driver = new Driver();
            if (request()->user()->cannot('delete', $driver)) {
                abort(403);
            }
                Driver::where('id', $id)->delete();
            return response()
                ->json(['message' => 'تم حذف السائق بنجاح', 'redirect' => route('drivers.index')]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function MultiDelete(Request $request)
    {
        try {
            if (request()->user()->cannot('MultiDelete', Driver::class)) {
                abort(403);
            }
    
            Driver::whereIn('id', (array) $request['ids'])->delete();
            return response()
                ->json(['message' => 'تم حذف السائق بنجاح', 'redirect' => route('drivers.index')]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function ImportForm()
    {
        return response()->json([
            'html' => view('drivers.import')->render(),
        ]);
    }

    public function export() 
    {
        return Excel::download(new DriversExport, 'السائقين.xlsx');
    }

    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);
  
        Excel::import(new DriversImport, $request->file('file'));
                 
        return back()->with('success', 'تم استيراد السائقين بنجاح');
    }
}
