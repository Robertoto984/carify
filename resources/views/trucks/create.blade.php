@extends('dashboard')
@section('content')

<div class="col-12">
    <h2 class="page-title mb-3">بطاقة مركبة</h2>
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

            <form method="POST" action="{{route('trucks.store')}}" class="submit-form">
                @csrf
                <div id="vehicle-forms-container">
                    <div class="vehicle-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="type">النوع</label>
                                    <input type="text" name="type[]" id="type" class="form-control">

                                    <span class="text-danger" id="type-error"></span>


                                </div>
                                <div class="form-group mb-3">
                                    <label for="manufacturer">الصانع</label>
                                    <input type="text" name="manufacturer[]" id="manufacturer" class="form-control">

                                    <span class="text-danger" id="manufacturer-error"></span>

                                </div>
                                <div class="form-group mb-3">
                                    <label for="plate_number">رقم اللوحة</label>
                                    <input type="text" name="plate_number[]" id="plate_number" class="form-control">

                                    <span class="text-danger" id="plate_number-error"></span>

                                </div>
                                <div class="form-group mb-3">
                                    <label for="chassis_number">رقم الشاسيه</label>
                                    <input type="text" name="chassis_number[]" id="chassis_number" class="form-control">

                                    <span class="text-danger" id="chassis_number-error"></span>

                                </div>
                                <div class="form-group mb-3">
                                    <label for="engine_number">رقم المحرك</label>
                                    <input type="text" name="engine_number[]" id="engine_number" class="form-control">

                                    <span class="text-danger" id="engine_number-error"></span>

                                </div>
                                <div class="form-group mb-3">
                                    <label for="traffic_license_number">رقم رخصة السير</label>
                                    <input type="text" name="traffic_license_number[]" id="traffic_license_number"
                                        class="form-control">

                                    <span class="text-danger" id="traffic_license_number-error"></span>

                                </div>
                                <div class="form-group mb-3">
                                    <label for="legal_status">الحالة القانونية</label>
                                    <input type="text" name="legal_status[]" id="legal_status" class="form-control">

                                    <span class="text-danger" id="legal_status-error"></span>

                                </div>
                                <div class="form-group mb-3">
                                    <label for="fuel_type">نوع الوقود</label>
                                    <select class="form-control" id="fuel_type" name="fuel_type[]">
                                        <option value="" disabled selected>اختر نوع الوقود</option>
                                        @foreach($fuelTypes as $fuelType)
                                        <option value="{{ $fuelType }}">{{ $fuelType }}</option>
                                        @endforeach
                                    </select>

                                    <span class="text-danger" id="fuel_type-error"></span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="passengers_number">عدد الركاب</label>
                                    <input type="text" name="passengers_number[]" id="passengers_number"
                                        class="form-control">


                                    <span class="text-danger" id="passengers_number-error"></span>


                                </div>
                                <div class="form-group mb-3">
                                    <label for="gross_weight">الوزن القائم</label>
                                    <input type="text" name="gross_weight[]" id="gross_weight" class="form-control">


                                    <span class="text-danger" id="gross_weight-error"></span>


                                </div>
                                <div class="form-group mb-3">
                                    <label for="empty_weight">الوزن الفارغ</label>
                                    <input type="text" name="empty_weight[]" id="empty_weight" class="form-control">


                                    <span class="text-danger" id="empty_weight-error"></span>


                                </div>
                                <div class="form-group mb-3">
                                    <label for="load">الحمولة</label>
                                    <input type="text" name="load[]" id="load" class="form-control">

                                    <span class="text-danger" id="load-error"></span>

                                </div>
                                <div class="form-group mb-3">
                                    <label for="kilometer_number">رقم العداد</label>
                                    <input type="text" name="kilometer_number[]" id="kilometer_number"
                                        class="form-control">

                                    <span class="text-danger" id="kilometer_number-error"></span>

                                </div>
                                <div class="form-group mb-3">
                                    <label for="technical_status">الحالة الفنية</label>
                                    <input type="text" name="technical_status[]" id="technical_status"
                                        class="form-control">

                                    <span class="text-danger" id="technical_status-error"></span>

                                </div>
                                <div class="form-group mb-3">
                                    <label for="color">اللون</label>
                                    <select class="form-control" id="color" name="color[]">
                                        <option value="" disabled selected>اختر اللون</option>
                                        @foreach($colors as $color)
                                        <option value="{{ $color }}">{{ $color }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="color-error"></span>

                                </div>
                                <div class="form-group mb-3 ">
                                    <label for="register">التسجيل</label>
                                    <div class="input-group">
                                        <input type="date" name="register[]" class="form-control" value="04/24/2020">

                                        <div class="input-group-append">
                                            <div class="input-group-text" id="button-addon-date"><span
                                                    class="fe fe-calendar fe-16"></span></div>
                                        </div>

                                    </div>
                                    <span class="text-danger" id="register-error"></span>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-4 mb-3 mb-3">
                                        <label for="year">السنة</label>
                                        <div class="input-group">
                                            <input type="date" name="year[]" class="form-control" value="04/24/2020">

                                            <div class="input-group-append">
                                                <div class="input-group-text" id="button-addon-date"><span
                                                        class="fe fe-calendar fe-16"></span></div>
                                            </div>
                                            <span class="text-danger" id="year-error"></span>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-3">
                                        <label for="demarcation_date">تاريخ الترسيم</label>
                                        <div class="input-group">
                                            <input type="date" name="demarcation_date[]" class="form-control"
                                                value="04/24/2020">

                                            <div class="input-group-append">
                                                <div class="input-group-text" id="button-addon-date"><span
                                                        class="fe fe-calendar fe-16"></span>
                                                </div>
                                            </div>
                                            <span class="text-danger" id="demarcation_date-error"></span>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-3 mb-3">
                                        <label for="model">الموديل</label>
                                        <div class="input-group">
                                            <input type="date" name="model[]" class="form-control" value="04/24/2020">

                                            <div class="input-group-append">
                                                <div class="input-group-text" id="button-addon-date"><span
                                                        class="fe fe-calendar fe-16"></span></div>
                                            </div>
                                            <span class="text-danger" id="model-error"></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="parts_description">توصيفات القطع</label>
                                    <textarea class="form-control" id="parts_description" name="parts_description"
                                        rows="4"></textarea>


                                    <span class="text-danger" id="parts_description-error"></span>


                                </div>
                            </div>
                        </div>
                        <div class="col mr-auto mb-5 mt-5">
                            <div class="dropdown">
                                <button type="submit" class="btn btn-success rounded-btn">حفظ</button>
                                <button type="button" id="add-form-btn" class="btn rounded-btn btn-primary">
                                    بطاقة مركبة جديدة
                                </button>
                                <button type="button" class="btn btn-danger rounded-btn delete-form-btn">
                                    إلغاء هذه البطاقة
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-form-btn').addEventListener('click', function () {
        const newForm = document.querySelector('.vehicle-form').cloneNode(true);
        const inputs = newForm.querySelectorAll('input');
        inputs.forEach(input => {
            if (!(input.classList.contains('drgpicker'))) {
                input.value = '';
            }
        });

        const deleteButton = newForm.querySelector('.delete-form-btn');
        deleteButton.addEventListener('click', function() {
            newForm.remove();
            checkDeleteButtonVisibility();
        });

        document.getElementById('vehicle-forms-container').appendChild(newForm);

        checkDeleteButtonVisibility();
    });

    function checkDeleteButtonVisibility() {
        const formCount = document.querySelectorAll('.vehicle-form').length;

        const deleteButtons = document.querySelectorAll('.delete-form-btn');
        deleteButtons.forEach(button => {
            if (formCount <= 1) {
                button.style.display = 'none';
            } 
            else {
                button.style.display = 'inline-block';
            }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            checkDeleteButtonVisibility();
        });
    
</script>

@endsection