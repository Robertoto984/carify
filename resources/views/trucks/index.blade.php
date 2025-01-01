@extends('dashboard')

@section('content')

<div class="col">
    <h2 class="mb-2 page-title">قائمة المركبات</h2>
</div>

<div class="col ml-auto">
    <div class="dropdown float-right">
        @can('create',\App\Models\Truck::class)

        <a href="{{ route('trucks.create') }}" class="btn btn-primary rounded-btn ml-10">+ بطاقة مركبة</a>
        @endcan
        @can('MultiDelete',\App\Models\Truck::class)

        <a id="bulkDeleteBtn" href="{{ route('trucks.bulk-delete') }}" class="btn rounded-btn btn-danger ml-auto">حذف
            المحدد</a>
        @endcan
        <button class="btn rounded-btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> المزيد </button>
        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
            <a class="dropdown-item more" href="{{ route('trucks.export') }}"><i
                    class="fa fa-download mr-2"></i>تصدير</a>
            <a class="dropdown-item more" href="{{route('trucks.import_form')}}" data-toggle="modal"
                data-target="#exampleModal" id="modal"><i class="fa-solid fa-file-import mr-2"></i>استيراد</a>
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
                                    <th><input type="checkbox" class="checkbox" id='check_all' /></th>
                                    <th>#</th>
                                    <th>النوع</th>

                                    <th>رقم اللوحة</th>

                                    <th>تاريخ الترسيم</th>
                                    <th>اللون</th>

                                    <th>الحمولة</th>
                                    <th>رقم العداد</th>

                                    <th>السائق</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trucks as $truck)
                                @php
                                $pending = $truck->movements->contains(function ($movement) {
                                return $movement->status == 1;
                                });
                                @endphp

                                <tr @if($pending) style="background-color: #FFA500;" @endif>
                                    <td><input type="checkbox" name="ids[]" value="{{ $truck->id }}" id="check" /></td>
                                    <td>{{ $truck->id }}</td>
                                    <td>{{ $truck->type }}</td>
                                    <td>{{ $truck->plate_number }}</td>
                                    <td>{{ $truck->demarcation_date }}</td>
                                    <td>{{ $truck->color }}</td>

                                    <td>{{ $truck->load }}</td>
                                    <td>{{ $truck->kilometer_number }}</td>

                                    <td class="td">
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


                                        <button class="btn rounded-btn btn-primary dropdown-toggle" type="button"
                                            id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"> العمليات </button>
                                        <div class="dropdown-menu" aria-labelledby="actionMenuButton"
                                            style="width:200px;right:auto;">
                                            @can('update',$truck)

                                            <a href="{{ route('trucks.create-deliver-order',$truck->id)}}"
                                                class="dropdown-item  deliver-order">
                                                <i class="fa fa-ticket"></i> بطاقة تسليم
                                            </a>

                                            <a id="modal" type="button" data-toggle="modal" data-target="#exampleModal"
                                                href="{{ route('trucks.edit',$truck->id) }}" class="dropdown-item ">
                                                <i class="fa fa-edit"></i> تعديل
                                            </a>
                                            @endcan
                                            @can('delete',$truck)

                                            <a href="{{ route('trucks.delete',$truck->id) }}" id="destroy"
                                                class="dropdown-item  btn-sm delete-driver" data-id="{{ $truck->id }}">
                                                <i class="fa fa-trash"></i> حذف
                                            </a>

                                            @endcan
                                            @can('create',\App\Models\MovementCommand::class)
                                            <a href="{{route('commands.create',['truck_id'=>$truck->id,'kilometer_number'=>$truck->kilometer_number])}}"
                                                class="dropdown-item "><i class="fa fa-plus"></i> أمر حركة</a>

                                            @endcan
                                            <a id="modal" type="button" data-toggle="modal" title="عرض"
                                                data-target="#exampleModal" href="{{ route('trucks.show',$truck->id) }}"
                                                class="dropdown-item "><i class="fa fa-eye" aria-hidden="true"></i>
                                                عرض</a>

                                        </div>
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