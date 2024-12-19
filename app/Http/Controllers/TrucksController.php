<?php

namespace App\Http\Controllers;

use App\Enums\Color;
use App\Enums\FuelTypes;
use App\Exports\TrucksExport;
use App\Http\Requests\Truck\StoreTruckRequest;
use App\Http\Requests\Truck\updateTruckRequest;
use App\Imports\TrucksImport;
use App\Models\Driver;
use App\Models\Truck;
use App\Services\Truck\StoreTruckService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TrucksController extends Controller
{
    protected $storeTruckService;

    public function __construct(StoreTruckService $storeTruckService)
    {
        $this->storeTruckService = $storeTruckService;
    }

    public function index()
    {
        if (request()->user()->cannot('index', Truck::class)) {
            abort(403);
        }
        $trucks = Truck::with('truckDeliverCards.driver')->get();
        return view('trucks.index', compact('trucks'));
    }

    public function create()
    {
        if (request()->user()->cannot('create', Truck::class)) {
            abort(403);
        }
        $colors = Color::values();
        $fuelTypes = FuelTypes::values();
        $drivers = Driver::all();
        return view('trucks.create', compact('colors', 'fuelTypes','drivers'));
    }

    
    public function edit($id)
    {
        $truck = new Truck();
        if (request()->user()->cannot('update', $truck)) {
            abort(403);
        }
        $row = Truck::findOrFail($id);
        $colors = Color::values();
        $fuelTypes = FuelTypes::values();
        $drivers = Driver::all();
        return response()->json([
            'html' => view('trucks.edit', ['row' => $row,'colors'=>$colors,'fuelTypes'=>$fuelTypes,'drivers'=>$drivers])->render(),
        ]);
    }
     public function store(StoreTruckRequest $request)
    {
        if (request()->user()->cannot('create', Truck::class)) {
            abort(403);
        }
        try {
            $this->storeTruckService->store($request->validated());

            return response()->json(['message'=>'تم إضافة المركبة بنجاح.','redirect'=>route('trucks.index')]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    
    public function update(updateTruckRequest $request,$id)
    {
        try {
            $truck = new Truck();
            if (request()->user()->cannot('update', $truck)) {
                abort(403);
            }
            $data = $request->validated();
            $this->storeTruckService->updateTruck($data,$id);
            return response()->json(['message'=>'تم تعديل المركبة بنجاح.','redirect'=>route('trucks.index')]);
        } catch (\Exception $e) {
            return response()->json(['message'=>'حدث خطأ أثناء تعديل المركبة:','redirect'=>route('trucks.index')]);

        }
    }

    public function destroy($id)
    {
        try {
            $truck = new Truck();
            if (request()->user()->cannot('delete', $truck)) {
                abort(403);
            }
            $ids = Truck::where('id',$id)->delete();
            return response()
            ->json(['message' => 'تم حذف المركبة بنجاح.','redirect'=>route('trucks.index')]);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function MultiDelete(Request $request)
    {
        try {
            if (request()->user()->cannot('MultiDelete', Truck::class)) {
                abort(403);
            }
            $ids = Truck::whereIn('id',(array)$request['ids'])->delete();
            return response()
            ->json(['message' => 'تم حذف المركبة بنجاح.','redirect'=>route('trucks.index')]);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function ImportForm()
    {
        return response()->json([
            'html' => view('trucks.import')->render(),
        ]);
    }

    public function export() 
    {
        return Excel::download(new TrucksExport, 'trucks.xlsx');
    }

    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);
  
        Excel::import(new TrucksImport, $request->file('file'));
                 
        return back()->with('success', 'تم استيراد المركبات بنجاح');
    }
}
