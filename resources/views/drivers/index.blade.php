@extends('dashboard')
@section('content')

<div class="col">
    <h2 class="mb-2 page-title">قائمة السائقين</h2>
</div>

<div class="col ml-auto">
    <div class="dropdown float-right">
        <a href="{{ route('drivers.create') }}" class="btn rounded-btn btn-primary ml-10">+ بطاقة سائق</a>
        <button class="btn rounded-btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> المزيد </button>
        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
            <a class="dropdown-item" href="#">Export</a>
            <a class="dropdown-item" href="#">Delete</a>
            <a class="dropdown-item" href="#">Something else here</a>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="row my-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table datatables" id="dataTable-1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم الأول</th>
                            <th>الكنية</th>
                            <th>تاريخ الميلاد</th>
                            <th>رقم الهاتف</th>
                            <th>العنوان</th>
                            <th>فئة الشهادة</th>
                            <th>تاريخ انتهاء الشهادة</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($drivers as $driver)
                                <tr>
                                    <td>{{ $driver->id }}</td>
                                    <td>{{ $driver->first_name }}</td>
                                    <td>{{ $driver->last_name }}</td>
                                    <td>{{ $driver->birth_date }}</td>
                                    <td>{{ $driver->phone }}</td>
                                    <td>{{ $driver->address }}</td>
                                    <td>{{ $driver->license_type }}</td>
                                    <td>{{ $driver->license_expiration_date }}</td>
                                    <td>
                                        {{-- <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-warning btn-sm"> --}}
                                        <a href="" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> تعديل
                                        </a>

                                        <button class="btn btn-danger btn-sm delete-driver" data-id="{{ $driver->id }}">
                                            <i class="fa fa-trash"></i> حذف
                                        </button>
                                    </td>
                                    <td>
                                        @foreach($driver->trucks as $truck)
                                            <p>{{ $truck->manufacturer }} {{ $truck->model }} (Plate: {{ $truck->plate_number }})</p>
                                        @endforeach
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