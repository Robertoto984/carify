<?php

namespace App\Http\Controllers;

use App\Enums\Color;
use App\Enums\FuelTypes;
use App\Http\Requests\Truck\StoreTruckRequest;
use App\Http\Requests\Truck\updateTruckRequest;
use App\Models\Driver;
use App\Models\Truck;
use App\Services\Truck\AddTruckService;
use Illuminate\Http\Request;
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

    
    public function edit($id)
    {
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
        try {
            $this->addTruckService->store($request->validated());

            return response()->json(['message'=>'تم إضافة المركبة بنجاح.','redirect'=>route('trucks.index')]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    
    public function update(updateTruckRequest $request,$id)
    {
        try {
            $data = $request->validated();
            $this->addTruckService->updateTruck($data,$id);
            return response()->json(['message'=>'تم تعديل المركبة بنجاح.','redirect'=>route('trucks.index')]);
        } catch (\Exception $e) {
            return response()->json(['message'=>'حدث خطأ أثناء تعديل المركبة:','redirect'=>route('trucks.index')]);

        }
    }

    public function destroy($id)
    {
        try {
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
            $ids = Truck::whereIn('id',(array)$request['ids'])->delete();
            return response()
            ->json(['message' => 'تم حذف المركبة بنجاح.','redirect'=>route('trucks.index')]);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
