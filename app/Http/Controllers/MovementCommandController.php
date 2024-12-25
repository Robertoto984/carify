<?php

namespace App\Http\Controllers;

use App\Exports\MovementCommandExport;
use App\Http\Requests\MovementCommand\MovementCommandRequest;
use App\Imports\MovementCommandImport;
use App\Models\Driver;
use App\Models\Escort;
use App\Models\MovementCommand;
use App\Models\Truck;
use App\Services\MovementCommand\StoreMovementCommandService;
use App\Services\MovementCommand\UpdateMovementCommandService;
use App\Traits\CommandNumGen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;

class MovementCommandController extends Controller
{
    use CommandNumGen;
    protected $storemovementService;
    protected $updatemovementService;

    public function __construct(
        StoreMovementCommandService $storemovementService,
        UpdateMovementCommandService $updatemovementService
    ) {
        $this->storemovementService = $storemovementService;
        $this->updatemovementService = $updatemovementService;
    }
    public function index()
    {
        $commands = MovementCommand::with(['driver', 'truck', 'escort'])
            ->paginate();
        return view('commands.index', compact('commands'));
    }

    public function create()
    {
        $trucks = Truck::select('id', 'plate_number')->get();
        $escorts = Escort::select('first_name', 'last_name', 'id')->get();
        $drivers = Driver::select('first_name', 'last_name', 'id')->get();
        $number = $this->generateCustomNumber();

        return view('commands.create', compact('trucks', 'escorts', 'drivers', 'number'));
    }

    public function store(MovementCommandRequest $request)
    {
        try {
            if (request()->user()->cannot('create', MovementCommand::class)) {
                abort(403);
            }
            $this->storemovementService->store($request->validated());
            return response()->json([
                'message' => 'تم إضافة الحركة بنجاح.',
                'redirect' => route('commands.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء إضافة الحركة.',
                'error' => $e->getMessage(),
                'redirect' => route('commands.index')
            ], 500);
        }
    }

    public function edit($id)
    {
        $command = new MovementCommand();
        if (request()->user()->cannot('update', $command)) {
            abort(403);
        }
        $trucks = Truck::select('id', 'plate_number')->get();
        $escorts = Escort::select('first_name', 'last_name', 'id')->get();
        $drivers = Driver::select('first_name', 'last_name', 'id')->get();
        $row = MovementCommand::with('escort')->where('id', $id)->first();
        return response()->json([
            'html' => view('commands.edit', [
                'row' => $row,
                'trucks' => $trucks,
                'escorts' => $escorts,
                'drivers' => $drivers
            ])->render(),
            'row' => $row
        ]);
    }

    public function update(MovementCommandRequest $request, $id)
    {
        try {
            $command = new MovementCommand();
            if (request()->user()->cannot('update', $command)) {
                abort(403);
            }
            $this->updatemovementService->update($request->validated(), $id);
            return response()->json([
                'message' => 'تم تعديل الحركة بنجاح.',
                'redirect' => route('commands.index')
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => $e->getMessage(),
                'redirect' => route('commands.index')
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $command = new MovementCommand();
            if (request()->user()->cannot('delete', $command)) {
                abort(403);
            }
            MovementCommand::where('id', $id)->delete();
            DB::table('movement_escorts')->where('mov_command_id', $id)->delete();
            return response()
                ->json(['message' => 'تم حذف الحركة بنجاح', 'redirect' => route('commands.index')]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function MultiDelete(Request $request)
    {
        try {
            if (request()->user()->cannot('MultiDelete', MovementCommand::class)) {
                abort(403);
            }
            Escort::whereIn('id', (array) $request['ids'])->delete();
            DB::table('movement_escorts')->whereIn('mov_command_id', (array) $request['ids'])->delete();

            return response()
                ->json(['message' => 'تم حذف الحركات بنجاح', 'redirect' => route('commands.index')]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function ImportForm()
    {
        return response()->json([
            'html' => view('commands.import')->render(),
        ]);
    }

    public function export()
    {
        return Excel::download(new MovementCommandExport, 'commands.xlsx');
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|max:2048',
            ]);

            Excel::import(new MovementCommandImport, $request->file('file'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function finish($id)
    {
        $trucks = Truck::select('id', 'plate_number')->get();
        $escorts = Escort::select('first_name', 'last_name', 'id')->get();
        $drivers = Driver::select('first_name', 'last_name', 'id')->get();
        $row = MovementCommand::with('escort')->where('id', $id)->first();
        return response()->json([
            'html' => view('commands.complete', [
                'row' => $row,
                'trucks' => $trucks,
                'escorts' => $escorts,
                'drivers' => $drivers
            ])->render(),
            'row' => $row
        ]);
    }
}
