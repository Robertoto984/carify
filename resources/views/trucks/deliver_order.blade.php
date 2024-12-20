@extends('dashboard')
@section('content')
 
<form method="POST" action="{{route('trucks.store-deliver-order')}}" class="submit-form"> 
    @csrf
    <div id="vehicle-forms-container">
        <div class="vehicle-form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3" hidden>
                        <label for="truck_id">معرف المركبة</label>
                        <input type="text" name="truck_id" value="{{ $truck->id }}" id="truck_id" class="form-control">
                        <span class="text-danger" id="truck-id-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="type">النوع</label>
                        <input type="text" name="type" value="{{ $truck->type }}" id="type" class="form-control">
                        <span class="text-danger" id="type-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="manufacturer">الصانع</label>
                        <input type="text" name="manufacturer" value="{{ $truck->manufacturer }}" id="manufacturer" class="form-control">
                        <span class="text-danger" id="manufacturer-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="plate_number">رقم اللوحة</label>
                        <input type="text" name="plate_number" value="{{ $truck->plate_number }}" id="plate_number" class="form-control">
                        <span class="text-danger" id="plate_number-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="chassis_number">رقم الشاسيه</label>
                        <input type="text" name="chassis_number" value="{{ $truck->chassis_number }}" id="chassis_number" class="form-control">
                        <span class="text-danger" id="chassis_number-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="engine_number">رقم المحرك</label>
                        <input type="text" name="engine_number" value="{{ $truck->engine_number }}" id="engine_number" class="form-control">
                        <span class="text-danger" id="engine_number-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="traffic_license_number">رقم رخصة السير</label>
                        <input type="text" name="traffic_license_number" value="{{ $truck->traffic_license_number }}" id="traffic_license_number"
                            class="form-control">
                        <span class="text-danger" id="traffic_license_number-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="legal_status">الحالة القانونية</label>
                        <input type="text" name="legal_status" value="{{ $truck->legal_status }}" id="legal_status" class="form-control">
                        <span class="text-danger" id="legal_status-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="fuel_type">نوع الوقود</label>
                        <input type="text" name="fuel_type" value="{{ $truck->fuel_type }}" id="fuel_type" class="form-control">
                        <span class="text-danger" id="fuel_type-error"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="passengers_number">عدد الركاب</label>
                        <input type="text" value="{{ $truck->passengers_number }}" name="passengers_number" id="passengers_number"
                            class="form-control">
                        <span class="text-danger" id="passengers_number-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gross_weight">الوزن القائم</label>
                        <input type="text" name="gross_weight" value="{{ $truck->gross_weight }}" id="gross_weight" class="form-control">
                        <span class="text-danger" id="gross_weight-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="empty_weight">الوزن الفارغ</label>
                        <input type="text" name="empty_weight" value="{{ $truck->empty_weight }}" id="empty_weight" class="form-control">
                        <span class="text-danger" id="empty_weight-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="load">الحمولة</label>
                        <input type="text" name="load" value="{{ $truck->load }}" id="load" class="form-control">
                        <span class="text-danger" id="load-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kilometer_number">رقم العداد</label>
                        <input type="text" name="kilometer_number" value="{{ $truck->kilometer_number }}" id="kilometer_number"
                            class="form-control">
                        <span class="text-danger" id="kilometer_number-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="technical_status">الحالة الفنية</label>
                        <input type="text" name="technical_status" value="{{ $truck->technical_status }}" id="technical_status"
                            class="form-control">
                        <span class="text-danger" id="technical_status-error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="color">اللون</label>
                        <input type="text" name="color" value="{{ $truck->color }}" id="color"
                            class="form-control">
                        <span class="text-danger" id="color-error"></span>
                    </div>
                    <div class="form-group mb-3 ">
                        <label for="register">التسجيل</label>
                        <div class="input-group">
                            <input type="text" name="register" value="{{ $truck->register }}" class="form-control" value="04/24/2020">
                            <div class="input-group-append">
                                <div class="input-group-text" id="button-addon-date">
                                    <span class="fe fe-calendar fe-16">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger" id="register-error"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-4 mb-3">
                            <label for="year">السنة</label>
                            <div class="input-group">
                                <input type="text" name="year" value="{{ $truck->year }}" class="form-control" value="04/24/2020">
                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date">
                                        <span class="fe fe-calendar fe-16">
                                        </span>
                                    </div>
                                </div>
                                <span class="text-danger" id="year-error"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4 mb-3">
                            <label for="demarcation_date">تاريخ الترسيم</label>
                            <div class="input-group">
                                <input type="text" name="demarcation_date" value="{{ $truck->demarcation_date }}" class="form-control"
                                    value="04/24/2020">
                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date">
                                        <span class="fe fe-calendar fe-16">
                                        </span>
                                    </div>
                                </div>
                                <span class="text-danger" id="demarcation_date-error"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4 mb-3 mb-3">
                            <label for="model">الموديل</label>
                            <div class="input-group">
                                <input type="text" name="model" class="form-control" value="{{ $truck->model }}" value="04/24/2020">
                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date">
                                        <span class="fe fe-calendar fe-16">
                                        </span>
                                    </div>
                                </div>
                                <span class="text-danger" id="model-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-4 mb-3">
                            <label for="receipt_date">تاريخ الاستلام</label>
                            <div class="input-group">
                                <input type="date" name="receipt_date" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date">
                                        <span
                                            class="fe fe-calendar fe-16">
                                        </span>
                                    </div>
                                </div>
                                <span class="text-danger" id="receipt_date-error"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4 mb-3">
                            <label for="deliver_date">تاريخ التسليم</label>
                            <div class="input-group">
                                <input type="date" name="deliver_date" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date">
                                        <span
                                            class="fe fe-calendar fe-16">
                                        </span>
                                    </div>
                                </div>
                                <span class="text-danger" id="deliver_date-error"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4 mb-3">
                        <label for="driver_id">السائق</label>
                        <select class="form-control" id="driver_id" name="driver_id">
                            <option value="" disabled selected>اختر السائق</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->first_name . ' '.  $driver->last_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="driver_id-error"></span>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col mr-auto mb-5 mt-5">
                <div class="dropdown">
                    <button type="submit" class="btn btn-success rounded-btn">حفظ</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection