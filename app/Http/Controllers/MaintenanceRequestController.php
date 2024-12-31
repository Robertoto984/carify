<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\Driver;
use App\Models\Product;
use App\Traits\CommandNumGen;
use App\Enums\MaintenanceTypes;
use Illuminate\Support\Facades\Log;
use App\Models\MaintenanceTypes as ModelsMaintenanceTypes;
use App\Services\MaintenanceRequest\StoreMaintenanceRequestService;
use App\Http\Requests\MaintenanceOrderRequest\StoreMaintenanceOrderRequest;
use App\Http\Requests\MaintenanceOrderRequest\UpdateMaintenanceOrderRequest;
use App\Models\MaintenanceRequest;
use App\Services\MaintenanceRequest\UpdateMaintenanceRequestService;

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

    public function edit($id)
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
                'maintenance_orders.edit',
                compact('row', 'procedures', 'drivers', 'trucks', 'products', 'types')
            )->render(),
        ]);
    }

    public function update(UpdateMaintenanceOrderRequest $request, $id)
    {
        try {
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
}
