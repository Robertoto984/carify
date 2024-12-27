<?php

namespace App\Http\Controllers;

use App\Exports\MaintenanceTypesExport;
use App\Imports\MaintenanceTypesImport;
use Illuminate\Http\Request;
use App\Models\MaintenanceTypes;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class MaintenanceTypesController extends Controller
{
    public function index()
    {
        $types = MaintenanceTypes::all();
        return view('maintenance.index', \compact('types'));
    }

    public function create()
    {
        return view('maintenance.create');
    }

    public function store()
    {
        $validated = request()->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
        ]);

        $maintenanceData = [];

        try {
            foreach ($validated['name'] as $type) {
                $maintenanceData[] = [
                    'name' => $type,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            MaintenanceTypes::insert($maintenanceData);

            return response()->json([
                'message' => 'تم إضافة الأنواع بنجاح.',
                'redirect' => route('maintenance.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء إضافة الأنواع.',
                'error' => $e->getMessage(),
                'redirect' => route('maintenance.index')
            ], 500);
        }
    }

    public function edit($id)
    {
        $row = MaintenanceTypes::findOrFail($id);
        return response()->json([
            'html' => view(
                'maintenance.edit',
                [
                    'row' => $row,
                ]
            )->render(),
        ]);
    }

    public function update($id)
    {
        $type = MaintenanceTypes::whereId($id)->first();

        if ($type) {
            $type->update(['name' => \request()->name]);

            return response()->json([
                'message' => 'تم تعديل النوع بنجاح.',
                'redirect' => route('maintenance.index')
            ]);
        } else {
            return response()->json([
                'message' => 'حدث خطأ أثناء تعديل النوع:',
                'redirect' => route('maintenance.index')
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            MaintenanceTypes::whereId($id)->delete();
            return response()->json([
                'message' => 'تم حذف النوع بنجاح',
                'redirect' => route('maintenance.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء حذف النوع:',
                'redirect' => route('maintenance.index')
            ]);
        }
    }

    public function MultiDelete(Request $request)
    {
        try {
            MaintenanceTypes::whereIn('id', (array)$request['ids'])->delete();
            return response()->json([
                'message' => 'تم حذف الأنواع بنجاح',
                'redirect' => route('maintenance.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء حذف الأنواع:',
                'redirect' => route('maintenance.index')
            ]);
        }
    }

    public function ImportForm()
    {
        return response()->json([
            'html' => view('maintenance.import')->render(),
        ]);
    }

    public function export()
    {
        return Excel::download(new MaintenanceTypesExport, 'أنواع الصيانة.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);
        try {

            Excel::import(new MaintenanceTypesImport, $request->file('file'));
            return response()->json([
                'message' => 'تم استيراد الأنواع بنجاح',
                'redirect' => route('maintenance.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء استيراد الأنواع:',
                'redirect' => route('maintenance.index')
            ]);
        }
    }
}
