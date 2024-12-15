@extends('dashboard')
@section('content')

<div class="col">
    <h2 class="mb-2 page-title">قائمة المركبات</h2>
</div>

<div class="col ml-auto">
    <div class="dropdown float-right">
        <a href="{{ route('trucks.create') }}" class="btn btn-primary rounded-btn ml-10">+ بطاقة مركبة</a>
        <button class="btn rounded-btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> المزيد </button>
        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
            <a class="dropdown-item" href="#">Export</a>
            <a class="dropdown-item" href="#">Delete</a>
            <a class="dropdown-item" id="MulitDelete" href="{{ route('trucks.delete_all') }}">Delete All Selected</a>

            <a class="dropdown-item" href="#">Something else here</a>
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
                                    <th>السنة</th>
                                    <th>التسجيل</th>
                                    <th>الموديل</th>
                                    <th>رقم اللوحة</th>
                                    <th>رقم الشاسيه</th>
                                    <th>رقم المحرك</th>
                                    <th>رقم رخصة السير</th>
                                    <th>تاريخ الترسيم</th>
                                    <th>اللون</th>
                                    <th>نوع الوقود</th>
                                    <th>عدد الركاب</th>
                                    <th>الوزن القائم</th>
                                    <th>الوزن الفارغ</th>
                                    <th>الحمولة</th>
                                    <th>رقم العداد</th>
                                    <th>الحالة الفنية</th>
                                    <th>الحالة القانونية</th>
                                    <th>توصيفات القطع</th>
                                    <th>السائق</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trucks as $truck)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="{{ $truck->id }}" id="check"/></td>
                                        <td>{{ $truck->id }}</td>
                                        <td>{{ $truck->type }}</td>
                                        <td>{{ $truck->manufacturer }}</td>
                                        <td>{{ $truck->plate_number }}</td>
                                        <td>{{ $truck->year }}</td>
                                        <td>{{ $truck->register }}</td>
                                        <td>{{ $truck->model }}</td>
                                        <td>{{ $truck->chassis_number }}</td>
                                        <td>{{ $truck->engine_number }}</td>
                                        <td>{{ $truck->traffic_license_number }}</td>
                                        <td>{{ $truck->demarcation_date }}</td>
                                        <td>{{ $truck->color }}</td>
                                        <td>{{ $truck->fuel_type }}</td>
                                        <td>{{ $truck->passengers_number }}</td>
                                        <td>{{ $truck->gross_weight }}</td>
                                        <td>{{ $truck->empty_weight }}</td>
                                        <td>{{ $truck->load }}</td>
                                        <td>{{ $truck->kilometer_number }}</td>
                                        <td>{{ $truck->technical_status }}</td>
                                        <td>{{ $truck->legal_status }}</td>
                                        <td>{{ $truck->parts_description }}</td>
                                        <td>
                                            @php
                                                $drivers = $truck->truckDeliverCards->map(function($deliverCard) {
                                                    return $deliverCard->driver;
                                                })->filter();
                                            @endphp
                                            
                                            @if($drivers->isNotEmpty())
                                                @foreach($drivers as $driver)
                                                    <p>{{ $driver->first_name }} {{ $driver->last_name }}</p>
                                                @endforeach
                                            @else
                                                <p>لا يوجد سائق</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i> تعديل
                                            </a>

                                            <button class="btn btn-danger btn-sm delete-driver" data-id="{{ $truck->id }}">
                                                <i class="fa fa-trash"></i> حذف
                                            </button>
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
