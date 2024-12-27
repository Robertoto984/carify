<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Models\Supplier;
use App\Services\Supplier\StoreSupplierService;
use App\Services\Supplier\UpdateSupplierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    protected $storeSupplierService;
    protected $updateSupplierService;

    public function __construct(
        StoreSupplierService $storeSupplierService,
        UpdateSupplierService $updateSupplierService
    ) {
        $this->storeSupplierService = $storeSupplierService;
        $this->updateSupplierService = $updateSupplierService;
    }

    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', \compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        try {
            $data = $request->validated();
            $this->storeSupplierService->store($data);
            return response()->json([
                'message' => 'تم إضافة المورّد بنجاح.',
                'redirect' => route('suppliers.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء إضافة المورّد:',
                'redirect' => route('suppliers.index')
            ]);
        }
    }

    public function update(StoreSupplierRequest $request, $id)
    {
        try {
            $this->updateSupplierService->update($request->validated(), $id);
            Log::debug($request->validated());
            return response()->json([
                'message' => 'تم تعديل المورّد بنجاح.',
                'redirect' => route('suppliers.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء تعديل المورّد:',
                'redirect' => route('suppliers.index')
            ]);
        }
    }

    public function edit($id)
    {
        $row = Supplier::findOrFail($id);
        return response()->json([
            'html' => view('suppliers.edit', ['row' => $row])->render(),
        ]);
    }

    public function destroy($id)
    {
        try {
            Supplier::where('id', $id)->delete();
            return response()->json([
                'message' => 'تم حذف المورّد بنجاح',
                'redirect' => route('suppliers.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء حذف المورّد:',
                'redirect' => route('suppliers.index')
            ]);
        }
    }

    public function MultiDelete(Request $request)
    {
        try {
            Supplier::whereIn('id', (array) $request['ids'])->delete();
            return response()->json([
                'message' => 'تم حذف الموردين بنجاح',
                'redirect' => route('suppliers.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء حذف الموردين:',
                'redirect' => route('suppliers.index')
            ]);
        }
    }
}
