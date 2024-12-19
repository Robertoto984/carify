@extends('dashboard')
@section('content')

<div class="col">
    <h2 class="mb-2 page-title">قائمة بطاقات التسليم</h2>
</div>

<div class="col ml-auto">
    <div class="dropdown float-right">
        <a id="bulkDeleteBtn" href="{{ route('trucks.bulk-delete') }}" class="btn rounded-btn btn-danger ml-auto">حذف المحدد</a>
        <button class="btn rounded-btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> المزيد </button>
        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
            <a class="dropdown-item more" href=""><i class="fa fa-download mr-2"></i>تصدير</a>
            <a class="dropdown-item more" href="#"><i class="fa-solid fa-file-import mr-2"></i>استيراد</a>
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
                                    <th>النوع</th>
                                    <th>الصانع</th>
                                    <th>رقم اللوحة</th>
                                    <th>السائق</th>
                                    <th>تاريخ الاستلام</th>
                                    <th>تاريخ التسليم</th>
                                    <th>تاريخ الترسيم</th>
                                    <th>السنة</th>
                                    <th>التسجيل</th>
                                    <th>الموديل</th>
                                    <th>رقم الشاسيه</th>
                                    <th>رقم المحرك</th>
                                    <th>رقم رخصة السير</th>
                                    <th>اللون</th>
                                    <th>نوع الوقود</th>
                                    <th>عدد الركاب</th>
                                    <th>الوزن القائم</th>
                                    <th>الوزن الفارغ</th>
                                    <th>الحمولة</th>
                                    <th>رقم العداد</th>
                                    <th>الحالة الفنية</th>
                                    <th>الحالة القانونية</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cards as $card)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="{{ $card->id }}" id="check"/></td>
                                        <td>{{$card->id}}</td>
                                        <td>{{$card->truck->type}}</td>
                                        <td>{{$card->truck->manufacturer}}</td>
                                        <td>{{$card->truck->plate_number}}</td>
                                        <td>{{$card->driver->first_name. ' '.$card->driver->last_name }}</td>
                                        <td>{{$card->receipt_date}}</td>
                                        <td>{{$card->deliver_date}}</td>
                                        <td>{{$card->truck->demarcation_date}}</td>
                                        <td>{{$card->truck->year}}</td>
                                        <td>{{$card->truck->register}}</td>
                                        <td>{{$card->truck->model}}</td>
                                        <td>{{$card->truck->chassis_number}}</td>
                                        <td>{{$card->truck->engine_number}}</td>
                                        <td>{{$card->truck->traffic_license_number}}</td>
                                        <td>{{$card->truck->color}}</td>
                                        <td>{{$card->truck->fuel_type}}</td>
                                        <td>{{$card->truck->passengers_number}}</td>
                                        <td>{{$card->truck->gross_weight}}</td>
                                        <td>{{$card->truck->empty_weight}}</td>
                                        <td>{{$card->truck->load}}</td>
                                        <td>{{$card->truck->kilometer_number}}</td>
                                        <td>{{$card->truck->technical_status}}</td>
                                        <td>{{$card->truck->legal_status}}</td>
                                        <td>
                                            <a id="modal" type="button" data-toggle="modal" data-target="#exampleModal" href="" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i> تعديل
                                            </a>
                                            <a href="" id="destroy" class="btn btn-danger btn-sm delete-driver" data-id="">
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
