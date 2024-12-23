@extends('dashboard')
@section('content')

<div class="col">
    <h2 class="mb-2 page-title">أوامر الحركة</h2>
</div>

<div class="col ml-auto">
    <div class="dropdown float-right">
        @can('create',\App\Models\MovementCommand::class)
            <a href="{{route('commands.create')}}" class="btn rounded-btn btn-primary">+ أمر حركة</a>
            @endcan
            @can('MultiDelete',\App\Models\MovementCommand::class)
            <a id="bulkDeleteBtn" href="{{ route('commands.bulk-delete') }}" class="btn rounded-btn btn-danger ml-auto">
                حذف المحدد
            </a>
            @endcan
        <button class="btn rounded-btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            المزيد
        </button>
        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
            <a class="dropdown-item more" href="{{ route('commands.export') }}"><i class="fa fa-download mr-2"></i>تصدير</a>
            <a class="dropdown-item more" href="{{route('commands.import_form')}}" data-toggle="modal" data-target="#exampleModal" id="modal"><i class="fa-solid fa-file-import mr-2" ></i>استيراد</a>
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
                                    <th>الرقم</th>
                                    <th>منظم الأمر</th>
                                    <th>التاريخ</th>
                                    <th>الجهة الطالبة</th>
                                    <th>رقم السيارة</th>
                                    <th>السائق</th>
                                    <th>المرافق</th>
                                    <th>وجهة التنقل</th>
                                    <th>المهمة</th>
                                    <th>توقيت البدء</th>
                                    <th>توقيت الانتهاء</th>
                                    <th>رقم العداد بداية</th>
                                    <th>رقم العداد نهاية</th>
                                    <th>المسافة المقطوعة</th>
                                    <th>ملاحظات</th>
                                    <th></th>
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach($commands as $command)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="" id="check"/></td>
                                        <td>{{ $command->number }}</td>
                                        <td>{{ $command->organized_by }}</td>
                                        <td>{{ $command->date }}</td>
                                        <td>{{ $command->responsible }}</td>
                                        <td>{{ $command->truck->plate_number }}</td>
                                        <td>{{ $command->driver->first_name }}{{ $command->driver->last_name }}</td>
                                        <td>
                                            @foreach ($command->escort as $escort)
                                            <br>
                                            <li>   {{ $escort->first_name .' '. $escort->last_name }} </li>
                                            @endforeach
                                        
                                        </td>
                                        <td>{{ $command->destination }}</td>
                                        <td>{{ $command->task }}</td>
                                       
                                        <td>{{ $command->task_start_time }}</td>
                                        <td>{{ $command->task_end_time }}</td>
                                        <td>{{ $command->initial_odometer_number }}</td>
                                        <td>{{ $command->final_odometer_number }}</td>
                                        <td>{{ $command->distance }}</td>
                                        <td>{{ $command->notes }}</td>
                                        <td>

                                            <a id="modal" type="button" data-toggle="modal" data-target="#exampleModal" href="{{ route('commands.finish',$command->id) }}" class="btn btn-success btn-sm">
                                                <i class="fa-regular fa-circle-check"></i> إنهاء
                                            </a>

                                            @can('delete',$command)

                                            <a id="modal" type="button" data-toggle="modal" data-target="#exampleModal" href="{{ route('commands.edit',$command->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i> تعديل
                                            </a>
                                            @endcan
                                            @can('update',$command)

                                            <a href="{{ route('commands.delete',$command->id) }}" id="destroy" class="btn btn-danger btn-sm delete-driver" data-id="">
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
