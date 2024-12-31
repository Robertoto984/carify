<?php

namespace App\Http\Controllers;

use App\Exports\SupplierExport;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Imports\SupplierImport;
use App\Models\Supplier;
use App\Services\Supplier\StoreSupplierService;
use App\Services\Supplier\UpdateSupplierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

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
        if (request()->user()->cannot('index', Supplier::class)) {
            abort(403);
        }
        $suppliers = Supplier::all();
        return view('suppliers.index', \compact('suppliers'));
    }

    public function create()
    {
        if (request()->user()->cannot('create', Supplier::class)) {
            abort(403);
        }
        return view('suppliers.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        try {
            if (request()->user()->cannot('create', Supplier::class)) {
                abort(403);
            }
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
            $supplier = new Supplier();
            if (request()->user()->cannot('update', $supplier)) {
                abort(403);
            }
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
        $supplier = new Supplier();
        if (request()->user()->cannot('update', $supplier)) {
            abort(403);
        }
        $row = Supplier::findOrFail($id);
        return response()->json([
            'html' => view('suppliers.edit', ['row' => $row])->render(),
        ]);
    }

    public function destroy($id)
    {
        try {
            $supplier = new Supplier();
            if (request()->user()->cannot('delete', $supplier)) {
                abort(403);
            }
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
            if (request()->user()->cannot('MultiDelete', Supplier::class)) {
                abort(403);
            }
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

    public function export()
    {
        return Excel::download(new SupplierExport, 'الموردين.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);
        try {

            Excel::import(new SupplierImport, $request->file('file'));
            return response()->json([
                'message' => 'تم استيراد الموردين بنجاح',
                'redirect' => route('suppliers.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء استيراد الأنواع:',
                'redirect' => route('suppliers.index')
            ]);
        }
    }
}
