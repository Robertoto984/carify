<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Product\StoreProductService;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\Product\UpdateProductService;

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
        $products = Product::with('supplier')->get();
        return view('products.index', \compact('products'));
    }

    public function create()
    {
        $suppliers = Supplier::select('id', 'trade_name')->get();
        return view('products.create', \compact('suppliers'));
    }

    public function edit($id)
    {
        $row = Product::findOrFail($id);
        $suppliers = Supplier::select('trade_name', 'name', 'id')->get();
        return response()->json([
            'html' => view('products.edit', ['row' => $row, 'suppliers' => $suppliers])->render(),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        try {
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
        Log::debug($request->all());
        try {
            $this->updateProductService->update($request->validated(), $id);
            Log::debug($request->validated());
            return response()->json([
                'message' => 'تم تعديل المادة بنجاح.',
                'redirect' => route('products.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء تعديل المادة:',
                // 'redirect' => route('products.index')
            ]);
        }
    }

    public function destroy($id)
    {
        try {
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
}
