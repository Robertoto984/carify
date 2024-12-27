<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        if (request()->user()->cannot('index', User::class)) {
            abort(403);
        }
        $users = User::with('role')->where('id', '!=', auth()->id())->paginate(5);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (request()->user()->cannot('create', User::class)) {
            abort(403);
        }
        $roles = Role::select('name', 'id')->get();
        return view('users.create', compact('roles'));
    }

    public function edit($id)
    {
        $user = new User();
        if (request()->user()->cannot('update', $user)) {
            abort(403);
        }
        $row = User::findOrFail($id);
        $roles = Role::select('name', 'id')->get();
        return response()->json([
            'html' => view('users.edit', ['row' => $row, 'roles' => $roles])->render(),
        ]);
    }

    public function store(StoreUserRequest $request)
    {

        try {
            if (request()->user()->cannot('create', User::class)) {
                abort(403);
            }
            $data = $request->validated();
            $this->service->store($data);
            return response()->json(['message' => 'تم إضافة المستخدمين بنجاح.', 'redirect' => route('users.index')]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'حدث خطأ أثناء إضافة المستخدمين:', 'redirect' => route('users.index')]);
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = new User();
            if (request()->user()->cannot('update', $user)) {
                abort(403);
            }
            $data = $request->validated();
            $this->service->update($data, $id);
            return response()->json(['message' => 'تم تعديل المستخدم بنجاح.', 'redirect' => route('users.index')]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'حدث خطأ أثناء تعديل المستخدم:', 'redirect' => route('users.index')]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = new User();
            if (request()->user()->cannot('delete', $user)) {
                abort(403);
            }
            User::where('id', $id)->delete();
            return response()
                ->json(['message' => 'تم حذف المستخدم بنجاح', 'redirect' => route('users.index')]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء حذف المستخدم:',
                'redirect' => route('users.index')
            ]);
        }
    }

    public function MultiDelete(Request $request)
    {
        try {
            if (request()->user()->cannot('MultiDelete', User::class)) {
                abort(403);
            }
            User::whereIn('id', (array)$request['ids'])->delete();
            return response()
                ->json(['message' => 'تم حذف المستخدم بنجاح', 'redirect' => route('users.index')]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ أثناء حذف المستخدمين:',
                'redirect' => route('users.index')
            ]);
        }
    }

    public function ImportForm()
    {
        return response()->json([
            'html' => view('users.import')->render(),
        ]);
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'المستخدمين.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return response()
            ->json(['message' =>  'تم استيراد المستخدمين بنجاح', 'redirect' => route('users.index')]);
    }
}
