@extends('dashboard')
@section('content')

<div class="col">
    <h2 class="mb-2 page-title">طلبات الصيانة</h2>
</div>

<div class="col ml-auto">
    <div class="dropdown float-right">
        @can('create',\App\Models\MaintenanceOrder::class)
            <a href="{{route('maintenance_orders.create')}}" class="btn rounded-btn btn-primary">+ طلب صيانة</a>
          @endcan
          @can('MultiDelete',\App\Models\MaintenanceOrder::class)

            <a id="bulkDeleteBtn" href="" class="btn rounded-btn btn-danger ml-auto">
                حذف المحدد
            </a>
            @endcan
        <button class="btn rounded-btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            المزيد
        </button>
        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
            <a class="dropdown-item more" href=""><i class="fa fa-download mr-2"></i>تصدير</a>
            <a class="dropdown-item more" href="" data-toggle="modal" data-target="#exampleModal" id="modal"><i class="fa-solid fa-file-import mr-2" ></i>استيراد</a>
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
                                <th><input type="checkbox" class="checkbox" id='check_all' /></th>
                                <th>#</th>
                                <th>الرقم</th>
                                <th>النوع</th>
                                <th>الإجراء</th>
                                <th>السائق</th>
                                <th>رقم السيارة</th>
                                <th>رقم العداد</th>
                                <th>المادة</th>
                                <th>الكمية</th>
                                <th>السعر</th>
                                <th>القيمة</th>
                                <th>القائم بالصيانة</th>
                                <th>القائم ملاحظات</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($drivers as $driver) --}}
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="" id="check" /></td>
                                    {{-- <td>{{ $driver->id }}</td> --}}
                                    
                                    <td>
                                        <a id="modal" type="button" data-toggle="modal" data-target="#exampleModal" href="" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> 
                                            تعديل
                                        </a>
                                        <a href="" id="destroy" class="btn btn-danger btn-sm delete-driver" data-id="">
                                            <i class="fa fa-trash"></i>
                                            حذف
                                        </a>
                                    </td>
                                </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection