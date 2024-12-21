@extends('dashboard')


@section('content')

<div class="col">
    <h2 class="mb-2 page-title">قائمة المستخدمين</h2>
</div>

<div class="col ml-auto">
    <div class="dropdown float-right">
        @can('create',\App\Models\User::class)

        <a href="{{ route('users.create') }}" class="btn btn-primary rounded-btn ml-10"> + بطاقة مستخدم</a>
        @endcan
        @can('MultiDelete',\App\Models\User::class)

        <a id="bulkDeleteBtn" href="{{ route('users.bulk-delete') }}" class="btn rounded-btn btn-danger ml-auto">حذف المحدد</a>
        @endcan
        <button class="btn rounded-btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> المزيد </button>
        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
               <a class="dropdown-item more" href="{{ route('users.export') }}"><i class="fa fa-download mr-2"></i>تصدير</a>
            <a class="dropdown-item more" href="{{route('users.import_form')}}" data-toggle="modal" data-target="#exampleModal" id="modal"><i class="fa-solid fa-file-import mr-2" ></i>استيراد</a>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="row my-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-container">
                        <div id="table-container"></div>

                        @if(session('success'))
                        <div class="alert alert-success" id="success">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger" id='danger'>{{ session('error') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif                                                                  
                        
                    <table class="table datatables" id="dataTable-1">
                        <thead>
                            <tr>
                               
                                <th><input type="checkbox"  class="checkbox"  id='check_all'/></th>

                                <th>#</th>
                                <th>الاسم </th>
                                <th>البريد الالكتروني</th>
                                <th>الوظيفة</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{ $user->id }}" id="check"/></td>

                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                        
                                    <td>
                                        @can('update',\App\Models\User::class)

                                        <a id="modal" type="button" data-toggle="modal" data-target="#exampleModal" href="{{ route('users.edit',$user->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> تعديل
                                        </a>
                                        @endcan
                                        @can('delete',\App\Models\User::class)

                                        <a href="{{ route('users.delete',$user->id) }}" id="destroy" class="btn btn-danger btn-sm delete-driver" data-id="{{ $user->id }}">
                                            <i class="fa fa-trash"></i> حذف
                                        </a>
                                        @endcan
                                    </td>
                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
