@extends('dashboard')
@section('content')

<div class="col-12">
    <h2 class="page-title mb-3">طلب صيانة</h2>
    <div class="card shadow mb-4">
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
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
            <form method="POST" action="{{route('maintenance_orders.store')}}" class="submit-form">
                @csrf
                <div id="vehicle-forms-container">
                    <div class="vehicle-form">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="number">الرقم</label>
                                    <input type="text" name="number[]" id="number" class="form-control number" value="{{ $number }}"
                                        readonly>
                                    <span class="text-danger" id="number-error"></span>
                                </div>
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label for="date">التاريخ</label>
                                <div class="input-group">
                                    <input type="date" name="date[]" class="date form-control"
                                        value="{{ date('Y-m-d') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text" id="button-addon-date">
                                            <span class="fe fe-calendar fe-16">
                                            </span>
                                        </div>
                                    </div>
                                    <span class="text-danger" id="date-error"></span>
                                </div>
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label for="type">نوع الصيانة</label>
                                <select class="form-control" id="type" name="type[]">
                                    <option value="" disabled selected>اختر النوع</option>
                                    @foreach($order_types as $ord_type)
                                    <option value="{{ $ord_type }}">{{ $ord_type}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="type-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 mb-3">
                                <label for="driver_id">السائق</label>
                                <select class="form-control" id="driver_id" name="driver_id[]">
                                    <option value="" disabled selected>اختر السائق</option>
                                    @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->first_name . ' '. $driver->last_name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="driver_id-error"></span>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="truck_id">رقم السيارة</label>
                                    <select name="truck_id[]" id="truck_id" class="selectpicker form-control"
                                        data-live-search="true">
                                        <option value="" disabled selected>اختر السيارة</option>
                                        @foreach ($trucks as $truck)
                                        <option value="{{ $truck->id }}"> {{ $truck->plate_number }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="truck_id-error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="odometer_number">رقم العداد</label>
                                    <input type="number" name="odometer_number[]" id="odometer_number"
                                        class="form-control odometer_number_0">
                                    <span class="text-danger" id="odometer_number-error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="created_by">القائم بالصيانة</label>
                                    <input type="text" name="created_by[]" id="created_by" class="form-control">
                                    <span class="text-danger" id="created_by-error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-order" style="background-color: rgba(0,0,0,.03);border:1px solid rgba(0,0,0,.125);">
                            <div class="row" style="margin: 10px">
                                <div class="form-group col-md-1 mb-3">
                                    <input class="form-control" id="" name="[]" value="1" placeholder="الرقم" autocomplete="true">

                                    <span class="text-danger" id="-error"></span>
                                </div>
                                <div class="form-group col-md-2 mb-3">
                                    <select class="form-control" id="type" name="maintenance_order_id[]">
                                        <option value=""  selected>الإجراء</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                    </select>
                                    <span class="text-danger" id="maintenance_order_id-error"></span>
                                </div>
                                <div class="form-group col-md-2 mb-3">
                                    <select class="form-control" id="product_id" name="product_id[]">
                                        <option value="" disabled selected>اختر المادة</option>
                                        @foreach($products as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="product_id-error"></span>
                                </div>
                                <div class="form-group col-md-2 mb-3">
                                    <input class="form-control" id="quantity" name="quantity[]" placeholder="الكمية" autocomplete="true">

                                    <span class="text-danger" id="quantity-error"></span>
                                </div>
                                <div class="form-group col-md-2 mb-3">
                                    <input class="form-control" id="unit_price" name="unit_price[]" placeholder="السعر" autocomplete="true">
                                    <span class="text-danger" id="unit_price-error"></span>
                                </div>
                                <div class="form-group col-md-2 mb-3">
                                    <input class="form-control" id="total_price" name="total_price[]" placeholder="الإجمالي" autocomplete="true">
                                    <span class="text-danger" id="total_price-error"></span>
                                </div>
                            </div>
                            <button type="button" id="add-new"></button>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="parts_description">الملاحظات</label>
                                <textarea class="form-control" id="notes" name="notes[]" rows="4"></textarea>
                                <span class="text-danger" id="notes-error"></span>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="total">الإجمالي</label>
                                <input class="form-control" id="total" name="total[]" />
                                <span class="text-danger" id="total-error"></span>
                            </div>
                        </div>

                        <div class="col mr-auto mb-5 mt-5">
                            <div class="ml-auto">
                            </div>
                            <div class="dropdown">
                                <button type="submit" class="btn btn-success rounded-btn">حفظ</button>
                                <button type="button" id="add-form-btn" class="btn rounded-btn btn-primary">
                                    طلب صيانة جديد
                                </button>
                                <button type="button" class="btn btn-danger rounded-btn delete-form-btn">
                                    إلغاء هذا الطلب
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/form-repeater.js') }}"></script>
@endsection