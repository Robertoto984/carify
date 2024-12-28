<?php

namespace App\Http\Controllers;

use App\Enums\MaintenanceTypes as EnumsMaintenanceTypes;
use Illuminate\Http\Request;
use App\Traits\CommandNumGen;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\MaintenanceOrderRequest\StoreMaintenanceOrderRequest;
use App\Models\Driver;
use App\Models\MaintenanceOrder;
use App\Models\MaintenanceTypes;
use App\Models\Product;
use App\Models\Truck;
use App\Services\MaintenanceOrder\StoreMaintenanceOrderService;

class MaintenanceOrderController extends Controller
{
    use CommandNumGen;

    protected $storeMaintenanceOrderService;

    public function __construct(StoreMaintenanceOrderService $storeMaintenanceOrderService)
    {
        $this->storeMaintenanceOrderService = $storeMaintenanceOrderService;
    }

    public function index()
    {
        $orders = MaintenanceOrder::with(['maintenanceTypes', 'products', 'driver', 'truck'])->get();
        return view('maintenance_orders.index', \compact('orders'));
    }

    public function create()
    {
        $trucks = Truck::select('id', 'plate_number')->get();
        $drivers = Driver::select('first_name', 'last_name', 'id')->get();
        $types = MaintenanceTypes::select('id', 'name')->get();
        $order_types = EnumsMaintenanceTypes::values();
        $products = Product::select('id', 'code', 'name', 'price')->get();
        $number = $this->generateCustomNumber();

        return view('maintenance_orders.create', \compact('trucks', 'drivers', 'types', 'products', 'number', 'order_types'));
    }

    public function store(StoreMaintenanceOrderRequest $request)
    {

        Log::debug('Request Data:', $request->all());

        try {
            $this->storeMaintenanceOrderService->store($request->validated());
            Log::debug('Total field:', $request->input('total'));
            return response()->json([
                'message' => 'تم إضافة الحركة بنجاح.',
                'redirect' => route('maintenance_orders.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء إضافة الحركة.',
                'error' => $e->getMessage(),
                'redirect' => route('maintenance_orders.index')
            ], 500);
        }
    }
}
