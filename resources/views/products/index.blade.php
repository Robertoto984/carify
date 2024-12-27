@extends('dashboard')


@section('content')

<div class="col">
    <h2 class="mb-2 page-title">قائمة المواد</h2>
</div>

<div class="col ml-auto">
    <div class="dropdown float-right">

        <a href="{{route('products.create')}}" class="btn btn-primary rounded-btn ml-10"> + بطاقة مادة</a>

        <a id="bulkDeleteBtn" href="{{ route('products.bulk-delete') }}" class="btn rounded-btn btn-danger ml-auto">حذف المحدد</a>
        <button class="btn rounded-btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> المزيد </button>
        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
               <a class="dropdown-item more" href="{{route('maintenance.export')}}"><i class="fa fa-download mr-2"></i>تصدير</a>
            <a class="dropdown-item more" href="{{route('maintenance.import_form')}}" data-toggle="modal" data-target="#exampleModal" id="modal"><i class="fa-solid fa-file-import mr-2" ></i>استيراد</a>
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
                                <th>الرمز</th>
                                <th>الاسم</th>
                                <th>الكمية</th>
                                <th>بلد المنشأ</th>
                                <th>تاريخ الإنتاج</th>
                                <th>تاريخ الإنتهاء</th>
                                <th>المورد</th>
                                <th>ملاحظات</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $item)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{$item->id}}" id="check"/></td>

                                    <td>{{$item->id}}</td>
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->origin_country}}</td>
                                    <td>{{$item->production_date}}</td>
                                    <td>{{$item->expireation_date}}</td>
                                    <td>{{$item->supplier->trade_name}}</td>
                                    <td>{{$item->notes}}</td>
                        
                                    <td>
                                        <a id="modal" type="button" data-toggle="modal" data-target="#exampleModal" href="{{ route('products.edit',$item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> تعديل
                                        </a>

                                        <a href="{{route('products.delete', $item->id)}}" id="destroy" class="btn btn-danger btn-sm delete-driver" data-id="{{$item->id}}">
                                            <i class="fa fa-trash"></i> حذف
                                        </a>
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
