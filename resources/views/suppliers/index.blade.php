@extends('dashboard')


@section('content')

<div class="col">
    <h2 class="mb-2 page-title">قائمة المورّدين</h2>
</div>

<div class="col ml-auto">
    <div class="dropdown float-right">
          @can('create',\App\Models\Supplier::class)
        <a href="{{route('suppliers.create')}}" class="btn btn-primary rounded-btn ml-10"> + بطاقة مورّد</a>
         @endcan
        @can('MultiDelete',\App\Models\Supplier::class)
        <a id="bulkDeleteBtn" href="{{ route('suppliers.bulk-delete') }}" class="btn rounded-btn btn-danger ml-auto">حذف المحدد</a>
         @endcan
        <button class="btn rounded-btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> المزيد </button>
        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
               <a class="dropdown-item more" href="{{route('suppliers.export')}}"><i class="fa fa-download mr-2"></i>تصدير</a>
            <a class="dropdown-item more" href="{{route('suppliers.import_form')}}" data-toggle="modal" data-target="#exampleModal" id="modal"><i class="fa-solid fa-file-import mr-2" ></i>استيراد</a>
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
                                <th>الاسم</th>
                                <th>الاسم التجاري</th>
                                <th>العنوان</th>
                                <th>البريد الإلكتروني</th>
                                <th>رقم الهاتف 1</th>
                                <th>رقم الهاتف 2</th>
                                <th>ملاحظات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suppliers as $supp)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{$supp->id}}" id="check"/></td>

                                    <td>{{$supp->id}}</td>
                                    <td>{{$supp->name}}</td>
                                    <td>{{$supp->trade_name}}</td>
                                    <td>{{$supp->address}}</td>
                                    <td>{{$supp->email}}</td>
                                    <td>{{$supp->phone_1}}</td>
                                    <td>{{$supp->phone_2}}</td>
                                    <td>{{$supp->notes}}</td>
                        
                                    <td>
                                         @can('update',$supp)
                                        <a id="modal" type="button" data-toggle="modal" title="تعديل" data-target="#exampleModal" href="{{route('suppliers.edit',$supp->id)}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> 
                                        </a>
                                         @endcan
                                        @can('delete',$supp)
                                        <a href="{{route('suppliers.delete', $supp->id)}}" title="حذف" id="destroy" class="btn btn-danger btn-sm delete-driver" data-id="{{$supp->id}}">
                                            <i class="fa fa-trash"></i> 
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
