<?php

namespace App\Http\Controllers;

use App\Enums\LicenseTypes;
use App\Exports\EscortsExport;
use App\Http\Requests\Escort\StoreEscortRequest;
use App\Http\Requests\Escort\UpdateEscortRequest;
use App\Imports\EscortsImport;
use App\Models\Escort;
use App\Services\Escort\StoreEscortService;
use App\Services\Escort\UpdateEscortService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EscortController extends Controller
{
    protected $storeEscortService;
    protected $updateEscortService;

    public function __construct(
        StoreEscortService $storeEscortService,
        UpdateEscortService $updateEscortService)
    {
        $this->storeEscortService = $storeEscortService;
        $this->updateEscortService = $updateEscortService;
    }

    public function index()
    {
        if (request()->user()->cannot('index', Escort::class)) {
            abort(403);
        }
        $escorts = Escort::all();
        return view('escorts.index', \compact('escorts'));
    }

    public function create()
    {
        if (request()->user()->cannot('create', Escort::class)) {
            abort(403);
        }
        $LicenseTypes = LicenseTypes::values();

        return view('escorts.create', compact('LicenseTypes'));
    }

    public function store(StoreEscortRequest $request)
    {
        try {
            if (request()->user()->cannot('create', Escort::class)) {
                abort(403);
            }
            $this->storeEscortService->storeEscorts($request->validated());

            return response()->json([
                'message' => 'تم إضافة المرافقين بنجاح.', 
                'redirect' => route('escorts.index')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'حدث خطأ أثناء إضافة المرافق.',
                'error' => $e->getMessage(),
                'redirect' => route('escorts.index')
            ], 500);
        }
    }

    public function edit($id)
    {
        $escort = new Escort();
        if (request()->user()->cannot('update', $escort)) {
            abort(403);
        }

        $row = Escort::findOrFail($id);
        $LicenseTypes = LicenseTypes::values();
        return response()->json([
            'html' => view('escorts.edit',[
                'row' => $row,
                'LicenseTypes' => $LicenseTypes
                ])->render(),
        ]);
    }

    public function update(UpdateEscortRequest $request, $id)
    {
        try {
            $escort = new Escort();
            if (request()->user()->cannot('update', $escort)) {
                abort(403);
            }
            $escortsData = $request->validated();
            $this->updateEscortService->updateEscort($escortsData, $id);
            return response()->json([
                'message' => 'تم تعديل المرافق بنجاح.', 
                'redirect' => route('escorts.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'redirect' => route('escorts.index')
            ]);

        }
    }

    public function destroy($id)
    {
        try {
            $escort = new Escort();
            if (request()->user()->cannot('delete', $escort)) {
                abort(403);
            }
            Escort::where('id', $id)->delete();
            return response()
                ->json(['message' => 'تم حذف المرافق بنجاح', 'redirect' => route('escorts.index')]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function MultiDelete(Request $request)
    {
        try {
            if (request()->user()->cannot('MultiDelete', Escort::class)) {
                abort(403);
            }
            Escort::whereIn('id', (array) $request['ids'])->delete();
            return response()
                ->json(['message' => 'تم حذف المرافقين بنجاح', 'redirect' => route('escorts.index')]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function ImportForm()
    {
        return response()->json([
            'html' => view('escorts.import')->render(),
        ]);
    }

    public function export() 
    {
        return Excel::download(new EscortsExport, 'المرافقين.xlsx');
    }

    public function import(Request $request) 
    {
        try{
            $request->validate([
                'file' => 'required|max:2048',
            ]);
      
            Excel::import(new EscortsImport, $request->file('file'));
            
         
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());

        }
        
    }
}
