<?php

namespace App\Http\Controllers;

use App\Enums\MaintenanceTypes;
use App\Exports\MaintenanceRequestExport;
use App\Http\Requests\MaintenanceOrderRequest\StoreMaintenanceOrderRequest;
use App\Http\Requests\MaintenanceOrderRequest\UpdateMaintenanceOrderRequest;
use App\Imports\MaintenanceRequestImport;
use App\Models\Driver;
use App\Models\MaintenanceRequest;
use App\Models\MaintenanceTypes as ModelsMaintenanceTypes;
use App\Models\Product;
use App\Models\Truck;
use App\Services\MaintenanceRequest\StoreMaintenanceRequestService;
use App\Services\MaintenanceRequest\UpdateMaintenanceRequestService;
use App\Traits\CommandNumGen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class MaintenanceRequestController extends Controller
{
    use CommandNumGen;

    protected $storeMaintenanceRequest;
    protected $updateMaintenanceRequest;

    public function __construct(
        StoreMaintenanceRequestService $storeMaintenanceRequest,
        UpdateMaintenanceRequestService $updateMaintenanceRequest
    ) {
        $this->storeMaintenanceRequest = $storeMaintenanceRequest;
        $this->updateMaintenanceRequest = $updateMaintenanceRequest;
    }

    public function index()
    {
        if (request()->user()->cannot('index', MaintenanceRequest::class)) {
            abort(403);
        }
        $requests = MaintenanceRequest::with(['truck', 'driver'])->get();
        return view('maintenance_orders.index', \compact('requests'));
    }

    public function create()
    {
        if (request()->user()->cannot('create', MaintenanceRequest::class)) {
            abort(403);
        }

        $trucks = Truck::select('id', 'plate_number')->get();
        $drivers = Driver::select('first_name', 'last_name', 'id')->get();
        $order_types = MaintenanceTypes::values();
        $products = Product::select('id', 'code', 'name', 'price')->get();
        $procedures = ModelsMaintenanceTypes::select('id', 'name')->get();
        $number = $this->generateMaintenanceOrderNumber();

        return view('maintenance_orders.create', compact('trucks', 'drivers', 'order_types', 'products', 'procedures', 'number'));
    }

    public function store(StoreMaintenanceOrderRequest $request)
    {
        try {
            $data = $request->validated();
            $this->storeMaintenanceRequest->store($data);
            return response()->json([
                'message' => 'تم إضافة الطلب بنجاح.',
                'redirect' => route('maintenance_orders.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'message' => 'حدث خطأ أثناء إضافة الطلب:',
                'redirect' => route('maintenance_orders.index')
            ]);
        }
    }

    public function show($id)
    {
       
        $row = MaintenanceRequest::with([
            'product' => function ($query) {
                $query->withPivot('procedure_id', 'quantity', 'unit_price', 'total_price');
            },
            'driver',
            'truck'
        ])
            ->where('id', $id)
            ->first();

        $procedures = ModelsMaintenanceTypes::select('id', 'name')->get();
        $drivers = Driver::select('id', 'first_name', 'last_name')->get();
        $trucks = Truck::select('id', 'plate_number')->get();
        $products = Product::select('id', 'name')->get();
        $types = MaintenanceTypes::values();

        return response()->json([
            'html' => view(
                'maintenance_orders.show',
                compact('row', 'procedures', 'drivers', 'trucks', 'products', 'types')
            )->render(),
        ]);
    }
    public function edit($id)
    {
        $m = new MaintenanceRequest();
        if (request()->user()->cannot('update', $m)) {
            abort(403);
        }
        $row = MaintenanceRequest::with([
            'product' => function ($query) {
                $query->withPivot('procedure_id', 'quantity', 'unit_price', 'total_price');
            },
            'driver',
            'truck'
        ])
            ->where('id', $id)
            ->first();

        $procedures = ModelsMaintenanceTypes::select('id', 'name')->get();
        $drivers = Driver::select('id', 'first_name', 'last_name')->get();
        $trucks = Truck::select('id', 'plate_number')->get();
        $products = Product::select('id', 'name')->get();
        $types = MaintenanceTypes::values();

        return response()->json([
            'html' => view(
                'maintenance_orders.edit',
                compact('row', 'procedures', 'drivers', 'trucks', 'products', 'types')
            )->render(),
        ]);
    }

    public function update(UpdateMaintenanceOrderRequest $request, $id)
    {
        try {
            $m = new MaintenanceRequest();
            if (request()->user()->cannot('update', $m)) {
                abort(403);
            }
            $data = $request->validated();
            $this->updateMaintenanceRequest->update($data, $id);
            return response()->json([
                'message' => 'تم تعديل الطلب بنجاح.',
                'redirect' => route('maintenance_orders.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'message' => 'حدث خطأ أثناء تعديل الطلب:',
                'redirect' => route('maintenance_orders.index')
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $m = new MaintenanceRequest();
            if (request()->user()->cannot('delete', $m)) {
                abort(403);
            }
            MaintenanceRequest::where('id', $id)->delete();
            DB::table('request_product')->where('request_id', $id)->delete();

            return response()
                ->json(['message' => 'تم حذف الطلبات بنجاح', 'redirect' => route('maintenance_orders.index')]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function MultiDelete(Request $request)
    {
        
        try {
            if (request()->user()->cannot('MultiDelete', MaintenanceRequest::class)) {
                abort(403);
            }
            DB::table('request_product')->whereIn('request_id', (array) $request['ids'])->delete();
            MaintenanceRequest::whereIn('id', (array) $request['ids'])->delete();
            return response()
                ->json(['message' => 'تم حذف الطلبات بنجاح', 'redirect' => route('maintenance_orders.index')]);

        } catch (\Exception $e) {
            
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function ImportForm()
    {
        return response()->json([
            'html' => view('maintenance_orders.import')->render(),
        ]);
    }

    public function export() 
    {
        return Excel::download(new MaintenanceRequestExport, 'طلبات الصيانه.xlsx');
    }

    public function import(Request $request) 
    {
        try{
            $request->validate([
                'file' => 'required|max:2048',
            ]);
      
            Excel::import(new MaintenanceRequestImport, $request->file('file'));
            
         
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());

        }
        
    }
}
