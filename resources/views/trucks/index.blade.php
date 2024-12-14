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
                            <th></th>
                            <th>#</th>
                            <th>النوع</th>
                            <th>الصانع</th>
                            <th>رقم اللوحة</th>
                            <th>رقم رخصة السير</th>
                            <th>السائق</th>
                            <th>نوع الوقود</th>
                            <th>تاريخ الترسيم</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                          <tr>
                            <td>368</td>
                            <td>Imani Lara</td>
                            <td>(478) 446-9234</td>
                            <td>Asset Management</td>
                            <td>Borland</td>
                            <td>9022 Suspendisse Rd.</td>
                            <td>High Wycombe</td>
                            <td>Jun 8, 2019</td>
                            <td></td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection