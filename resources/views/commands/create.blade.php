@extends('dashboard')

@section('content')

<div class="col-12">
    <h2 class="page-title mb-3">أمر حركة</h2>
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

            <form method="POST" action="{{ route('commands.store') }}" class="submit-form">
                @csrf
                <div id="vehicle-forms-container">
                    <div class="vehicle-form">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="number">الرقم</label>
                                    <input type="text" name="number[]" id="number" class="form-control number"
                                        value="{{ $number }}" readonly>
                                    <span class="text-danger" id="number-error"></span>
                                </div>
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label for="date">التاريخ</label>
                                <div class="input-group">
                                    <input type="date" name="date[]" class="form-control" value="{{ date('Y-m-d') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text" id="button-addon-date">
                                            <span class="fe fe-calendar fe-16">
                                            </span>
                                        </div>
                                    </div>
                                    <span class="text-danger" id="date-error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="responsible">الجهة المسؤولة</label>
                                    <input type="text" name="responsible[]" id="responsible" class="form-control">
                                    <span class="text-danger" id="responsible-error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="truck_id">رقم السيارة</label>
                                    <select name="truck_id[]" id="truck_id"
                                        class="selectpicker selectpicker_0 form-control" data-live-search="true">
                                        <option value="" disabled selected>اختر السيارة</option>
                                        @foreach ($trucks as $truck)
                                        <option value="{{ $truck->id }}">{{ $truck->plate_number }}</option>
                                        @endforeach
                                    </select>


                                    <span class="text-danger" id="truck_id-error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 mb-3">
                                <label for="driver_id">السائق</label>
                                <select class="form-control" id="driver_id" name="driver_id[]">
                                    <option value="" disabled selected>اختر السائق</option>
                                    @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->first_name . ' '. $driver->last_name
                                        }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="driver_id-error"></span>
                            </div>
                            <div class="form-group center col-md-4 mb-3">
                                <label for="escort_id">المرافق</label>
                                <select class="selectpicker selectpicker_2 form-control" id="escort_id"
                                    name="escort_id[]" multiple >
                                    <option value="" disabled>اختر المرافق</option>
                                    @foreach($escorts as $escort)
                                    <option value="{{ $escort->id }}">{{ $escort->first_name . ' '. $escort->last_name
                                        }}</option>
                                    @endforeach
                                </select>


                                <span class="text-danger" id="escort_id-error"></span>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group mb-3">
                                    <label for="destination">وجهة التنقل</label>
                                    <input type="text" name="destination[]" id="destination" class="form-control">
                                    <span class="text-danger" id="destination-error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label for="task_start_time">توقيت البدء</label>
                                    <input type="time" name="task_start_time[]" id="task_start_time" value="{{ date("
                                        H:i") }}" class="form-control">
                                    <span class="text-danger" id="task_start_time-error"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label for="task_end_time">توقيت الانتهاء</label>
                                    <input type="time" name="task_end_time[]" id="task_end_time" class="form-control">
                                    <span class="text-danger" id="task_end_time-error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="initial_odometer_number">العداد عند البدء</label>
                                    <input type="number" name="initial_odometer_number[]" id="initial_odometer_number"
                                        class="form-control initial_odometer_number_0">
                                    <span class="text-danger" id="initial_odometer_number-error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="final_odometer_number">العداد عند الانتهاء</label>

                                    <input type="number" name="final_odometer_number[]" id="final_odometer_number"
                                        class="form-control final_odometer_number_0">

                                    <span class="text-danger" id="final_odometer_number-error"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label for="distance">المسافة المقطوعة</label>
                                    <input type="number" name="distance[]" id="distance" value=""
                                        class="form-control distance_0" readonly>
                                    <span class="text-danger" id="distance-error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="task">المهمة</label>
                                    <textarea class="form-control" id="task" name="task[]" rows="4">
                                    </textarea>
                                    <span class="text-danger" id="task-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="notes">ملاحظات</label>
                                    <textarea class="form-control" id="notes" name="notes[]" rows="4">
                                    </textarea>
                                    <span class="text-danger" id="notes-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col mr-auto mb-5 mt-5">
                            <div class="dropdown">
                                <button type="submit" class="btn btn-success rounded-btn">حفظ</button>
                                <button type="button" id="add-form-btn" class="btn rounded-btn btn-primary">
                                    أمر حركة جديد
                                </button>
                                <button type="button" class="btn btn-danger rounded-btn delete-form-btn">
                                    إلغاء هذا الأمر
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
<script>

    document.getElementById('add-form-btn').addEventListener('click', function () {
        
        const newForm = document.querySelector('.vehicle-form').cloneNode(true);
        const inputs = newForm.querySelectorAll('input');
        // Refresh selectpicker
        const final = $('.final_odometer_number_0')
        const number = $('#number').val()
        const selects = newForm.querySelectorAll('.selectpicker');

        selects.forEach(select=>{
            if(select.classList.contains('selectpicker_0')){
                select.classList.remove("selectpicker_0"); // Remove mystyle class from DIV
                select.classList.add("selectpicker_1"); 
                // $('.selectpicker_1').selectpicker();
            $('.selectpicker_1').selectpicker('refresh'); 
           
             }
             if(select.classList.contains('selectpicker_2')){
                select.classList.remove("selectpicker_2"); // Remove mystyle class from DIV
                select.classList.add("selectpicker_3"); 
                // $('.selectpicker_3').selectpicker();
            $('.selectpicker_3').selectpicker('refresh'); 
           
             }
        })
        inputs.forEach(input => {
            if(input.classList.contains('number')){
            input.value = number+1
             }
          
            if(input.classList.contains('final_odometer_number_0')){
            input.classList.remove("final_odometer_number_0"); // Remove mystyle class from DIV
            input.classList.add("final_odometer_number_1"); // add mystyle class from DIV
           
             }
             if( input.classList.contains('initial_odometer_number_0')  ){
          
            input.classList.remove("initial_odometer_number_0"); // Remove mystyle class from DIV
            input.classList.add("initial_odometer_number_1"); // add mystyle class from DIV
           
             }
             if( input.classList.contains('distance_0') ){
           
            input.classList.remove("distance_0"); // Remove mystyle class from DIV
            input.classList.add("distance_1"); // add mystyle class from DIV
             }
            if (!(input.classList.contains('drgpicker')) && !(input.classList.contains('number')) ) {
                
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
<script>
    //calc distance 
    for(let i=0; i<=2; i++){

        $(document).on('input',`.final_odometer_number_${i}`,function(e){
          let distance = $(`.final_odometer_number_${i}`).val()-$(`.initial_odometer_number_${i}`).val()
             $(`.distance_${i}`).val(distance)
        
          })
    }
   
</script>
@endsection