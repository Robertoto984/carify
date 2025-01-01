<form method="POST" action="{{route('trucks.update',['id'=>$row->id])}}" class="submit-form">
    @csrf
    <div id="vehicle-forms-container">
        <div class="vehicle-form">
                   <div class="row">
                    <div class="col-md-4 form-group mb-3">
                        <label for="type">النوع</label>
                        <input type="text" name="type" value="{{ $row->type }}" id="type" class="form-control" readonly>
                        <span class="text-danger" id="type-error"></span>

                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label for="manufacturer">الصانع</label>
                        <input type="text" name="manufacturer" value="{{ $row->manufacturer }}" id="manufacturer"
                            class="form-control" readonly>
                        <span class="text-danger" id="manufacturer-error"></span>

                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label for="plate_number">رقم اللوحة</label>
                        <input type="text" name="plate_number" value="{{ $row->plate_number }}" id="plate_number"
                            class="form-control" readonly>
                        <span class="text-danger" id="plate_number-error"></span>

                    </div>
                   </div>
                  <div class="row">
                    <div class="col-md-4 form-group mb-3">
                        <label for="chassis_number">رقم الشاسيه</label>
                        <input type="text" name="chassis_number" value="{{ $row->chassis_number }}" id="chassis_number"
                            class="form-control" readonly>
                        <span class="text-danger" id="chassis_number-error"></span>

                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label for="engine_number">رقم المحرك</label>
                        <input type="text" name="engine_number" value="{{ $row->engine_number }}" id="engine_number"
                            class="form-control" readonly>
                        <span class="text-danger" id="engine_number-error"></span>

                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label for="traffic_license_number">رقم رخصة السير</label>
                        <input type="text" name="traffic_license_number" value="{{ $row->traffic_license_number }}"
                            id="traffic_license_number" class="form-control" readonly>
                        <span class="text-danger" id="traffic_license_number-error"></span>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 form-group mb-3">
                        <label for="legal_status">الحالة القانونية</label>
                        <input type="text" name="legal_status" value="{{ $row->legal_status }}" id="legal_status"
                            class="form-control" readonly>
                        <span class="text-danger" id="legal_status-error"></span>

                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label for="fuel_type">نوع الوقود</label>
                        <select class="form-control" id="fuel_type" name="fuel_type" readonly>
                            <option value="" disabled selected>اختر نوع الوقود</option>
                            @foreach($fuelTypes as $fuelType)
                            <option value="{{ $fuelType }}" {{ $row->fuel_type == $fuelType ? 'selected':'' }}>{{
                                $fuelType }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="fuel_type-error"></span>

                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label for="passengers_number">عدد الركاب</label>
                        <input type="text" name="passengers_number" value="{{ $row->passengers_number }}"
                            id="passengers_number" class="form-control" readonly>
                        <span class="text-danger" id="passengers_number-error"></span>

                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-4 form-group mb-3">
                        <label for="gross_weight">الوزن القائم</label>
                        <input type="text" name="gross_weight" value="{{ $row->gross_weight }}" id="gross_weight"
                            class="form-control" readonly>
                        <span class="text-danger" id="gross_weight-error"></span>

                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label for="empty_weight">الوزن الفارغ</label>
                        <input type="text" name="empty_weight" value="{{ $row->empty_weight }}" id="empty_weight"
                            class="form-control" readonly>
                        <span class="text-danger" id="empty_weight-error"></span>

                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label for="load">الحمولة</label>
                        <input type="text" name="load" value="{{ $row->load }}" id="load" class="form-control" readonly>
                        <span class="text-danger" id="load-error"></span>

                    </div>
                   </div>
                   <div class="row">
                    <div class="col-md-4 form-group mb-3">
                        <label for="kilometer_number">رقم العداد</label>
                        <input type="text" name="kilometer_number" value="{{ $row->kilometer_number }}"
                            id="kilometer_number" class="form-control" readonly>
                        <span class="text-danger" id="kilometer_number-error"></span>

                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label for="technical_status">الحالة الفنية</label>
                        <input type="text" name="technical_status" value="{{ $row->technical_status }}"
                            id="technical_status" class="form-control" readonly>
                        <span class="text-danger" id="technical_status-error"></span>

                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label for="color">اللون</label>
                        <select class="form-control" id="color" name="color" readonly>
                            <option value="" disabled selected>اختر اللون</option>
                            @foreach($colors as $color)
                            <option value="{{ $color }}" {{ $row->color == $color ? 'selected' :'' }}>{{ $color }}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="color-error"></span>

                    </div>
                   </div>
                   
                
                    <div class="row">
                        <div class="form-group col-md-3 mb-3 ">
                            <label for="year">السنة</label>
                            <div class="input-group">
                                <input type="text" name="year" value="{{ $row->year ?? " 04/24/2020"}}"
                                    class="form-control drgpicker" id="year" aria-describedby="button-addon" readonly>

                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date"><span
                                            class="fe fe-calendar fe-16"></span></div>
                                </div>
                                <span class="text-danger" id="year-error"></span>

                            </div>
                        </div>
                        <div class="form-group col-md-3 mb-3">
                            <label for="demarcation_date">تاريخ الترسيم</label>
                            <div class="input-group">
                                <input type="date" name="demarcation_date" value="{{ $row->demarcation_date ?? "
                                    04/24/2020" }}" class="form-control drgpicker" id="year"
                                    aria-describedby="button-addon" readonly>

                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date"><span
                                            class="fe fe-calendar fe-16"></span>
                                    </div>
                                </div>
                                <span class="text-danger" id="demarcation_date-error"></span>

                            </div>
                        </div>
                        <div class="form-group col-md-3 mb-3 ">
                            <label for="model">الموديل</label>
                            <div class="input-group">
                                <input type="text" name="model" value="{{ $row->model ?? " 04/24/2020"}}"
                                    class="form-control drgpicker" id="year" aria-describedby="button-addon" readonly>

                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date"><span
                                            class="fe fe-calendar fe-16"></span></div>
                                </div>
                                <span class="text-danger" id="model-error"></span>

                            </div>
                        </div>
                        <div class="col-md-3 form-group mb-3 ">
                            <label for="register">التسجيل</label>
                            <div class="input-group">
                                <input type="text" name="register" value="{{ $row->register }}"
                                    class="form-control drgpicker" id="year" value="04/24/2020"
                                    aria-describedby="button-addon" readonly>
    
                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date"><span
                                            class="fe fe-calendar fe-16"></span></div>
                                </div>
                                <span class="text-danger" id="register-error"></span>
    
                            </div>
                        </div>
                    </div>
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="parts_description">توصيفات القطع</label>
                        <textarea class="form-control" id="parts_description" name="parts_description"
                            rows="4" readonly>{{ $row->parts_description }}</textarea>
                        <span class="text-danger" id="parts_description-error"></span>

                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-btn" data-dismiss="modal">إغلاق</button>
                <button type="submit" class="btn btn-success rounded-btn">حفظ</button>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
          $('.drgpicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 2000,
            maxYear: parseInt(moment().format('YYYY'), 10),
            locale: {
                format: 'YYYY-MM-DD' // Format to display
            }
        }, function(start, end, label) {
            // Optional: You can handle any actions after a date is selected
            if (!start.isValid()) {
                alert("Please select a valid date!");
            } else {
                var years = moment().diff(start, 'years');
                console.log("You are " + years + " years old!");
            }
        });
</script>