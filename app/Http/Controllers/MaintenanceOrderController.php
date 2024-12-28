<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CommandNumGen;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\MaintenanceOrderRequest\StoreMaintenanceOrderRequest;

class MaintenanceOrderController extends Controller
{
    use CommandNumGen;

    public function index()
    {
        return view('maintenance_orders.index');
    }

    public function create()
    {
        return view('maintenance_orders.create');
    }

    public function store(StoreMaintenanceOrderRequest $request)
    {
        try {

            $this->storemovementService->store($request->validated());
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
