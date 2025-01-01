@extends('dashboard')
@section('content')

<div class="col">
    <h2 class="mb-2 page-title">طلبات الصيانة</h2>
</div>

<div class="col ml-auto">
    <div class="dropdown float-right">
         @can('create',\App\Models\MaintenanceRequest::class)
            <a href="{{route('maintenance_orders.create')}}" class="btn rounded-btn btn-primary">+ طلب صيانة</a>
             @endcan
          @can('MultiDelete',\App\Models\MaintenanceRequest::class)
            <a id="bulkDeleteBtn" href="{{ route('maintenance_orders.bulk-delete') }}" class="btn rounded-btn btn-danger ml-auto">حذف المحدد </a>
             @endcan
        <button class="btn rounded-btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            المزيد
        </button>
        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
            <a class="dropdown-item more" href="{{ route('maintenance_orders.export') }}"><i class="fa fa-download mr-2"></i>تصدير</a>
            <a class="dropdown-item more" href="{{ route('maintenance_orders.import_form') }}" data-toggle="modal" data-target="#exampleModal" id="modal"><i class="fa-solid fa-file-import mr-2" ></i>استيراد</a>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="row my-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
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
                                <th><input type="checkbox"  class="checkbox" id='check_all' /></th>
                                <th>#</th>
                                <th>الرقم</th>
                                <th>النوع</th>
                                <th>السائق</th>
                                <th>رقم السيارة</th>
                                <th>رقم العداد</th>
                                <th>القيمة</th>
                                <th>القائم بالصيانة</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $req)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{ $req->id }}" id="check" /></td>
                                    <td>{{ $req->id }}</td>
                                    <td>{{ $req->number }}</td>
                                    <td>{{ $req->type }}</td>
                                    <td>{{ $req->driver->first_name.' '.$req->driver->last_name }}</td>
                                    <td>{{ $req->truck->plate_number }}</td>
                                    <td>{{ $req->odometer_number }}</td>
                                    <td>{{ $req->total }}</td>
                                    <td>{{ $req->created_by }}</td>
                                    
                                    <td>
                                        
                                        <a id="modal" type="button" data-toggle="modal" title="عرض" data-target="#exampleModal" href="{{ route('maintenance_orders.show',$req->id) }}" class="btn btn-success btn-sm">
                                            <i class="fa fa-eye" aria-hidden="true"></i> 
                                            {{-- عرض --}}
                                        </a>
                                       
                                        @can('update',$req)
                                        <a id="modal" type="button" data-toggle="modal" data-target="#exampleModal" title="تعديل" href="{{ route('maintenance_orders.edit',$req->id) }}" class="btn btn-primary btn-sm" >
                                            <i class="fa fa-edit"></i> 
                                            {{-- تعديل --}}
                                        </a>
                                        @endcan
                                        @can('delete',$req)
                                        <a href="{{ route('maintenance_orders.delete',$req->id) }}" id="destroy" title="حذف" class="btn btn-danger btn-sm delete-driver" data-id="">
                                            <i class="fa fa-trash"></i>
                                            {{-- حذف --}}
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
@endsection