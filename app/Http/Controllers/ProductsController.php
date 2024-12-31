<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use Illuminate\Support\Facades\Log;
use App\Services\Product\StoreProductService;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Imports\ProductImport;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\Product\UpdateProductService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
    protected $storeProductService;
    protected $updateProductService;

    public function __construct(
        StoreProductService $storeProductService,
        UpdateProductService $updateProductService
    ) {
        $this->storeProductService = $storeProductService;
        $this->updateProductService = $updateProductService;
    }

    public function index()
    {
        if (request()->user()->cannot('index', Product::class)) {
            abort(403);
        }
        $products = Product::with('supplier')->get();
        return view('products.index', \compact('products'));
    }

    public function create()
    {
        if (request()->user()->cannot('create', Product::class)) {
            abort(403);
        }
        $suppliers = Supplier::select('id', 'trade_name')->get();
        return view('products.create', \compact('suppliers'));
    }

    public function edit($id)
    {
        $product = new Product();
        if (request()->user()->cannot('update', $product)) {
            abort(403);
        }
        $row = Product::findOrFail($id);
        $suppliers = Supplier::select('trade_name', 'name', 'id')->get();
        return response()->json([
            'html' => view('products.edit', ['row' => $row, 'suppliers' => $suppliers])->render(),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            if (request()->user()->cannot('create', Product::class)) {
                abort(403);
            }
            $data = $request->validated();

            $this->storeProductService->store($data);
            return response()->json([
                'message' => 'تم إضافة المواد بنجاح.',
                'redirect' => route('products.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء إضافة المواد:',
                'redirect' => route('products.index')
            ]);
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = new Product();
            if (request()->user()->cannot('update', $product)) {
                abort(403);
            }
            $this->updateProductService->update($request->validated(), $id);
            return response()->json([
                'message' => 'تم تعديل المادة بنجاح.',
                'redirect' => route('products.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء تعديل المادة:',
                'redirect' => route('products.index')
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $product = new Product();
            if (request()->user()->cannot('delete', $product)) {
                abort(403);
            }
            Product::where('id', $id)->delete();
            return response()->json([
                'message' => 'تم حذف المادة بنجاح',
                'redirect' => route('products.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء حذف المادة:',
                'redirect' => route('products.index')
            ]);
        }
    }

    public function MultiDelete(Request $request)
    {
        try {
            if (request()->user()->cannot('MultiDelete', Product::class)) {
                abort(403);
            }
            Product::whereIn('id', (array) $request['ids'])->delete();
            return response()->json([
                'message' => 'تم حذف المواد بنجاح',
                'redirect' => route('products.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء حذف المواد:',
                'redirect' => route('products.index')
            ]);
        }
    }

    public function export()
    {
        return Excel::download(new ProductExport, 'مواد الصيانه.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);
        try {

            Excel::import(new ProductImport, $request->file('file'));
            return response()->json([
                'message' => 'تم استيراد المواد بنجاح',
                'redirect' => route('products.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء استيراد المواد:',
                'redirect' => route('products.index')
            ]);
        }
    }
}
