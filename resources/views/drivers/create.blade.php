@extends('dashboard')
@section('content')

<div class="col-12">
    <h2 class="page-title mb-3">إضافة سائق</h2>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('drivers.store') }}">
                @csrf
                <div id="vehicle-forms-container">
                    <div class="vehicle-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="first_name">الاسم الأول</label>
                                    <input type="text" name="first_name[]" id="first_name" class="form-control">
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="last_name">الكنية</label>
                                    <input type="text" name="last_name[]" id="last_name" class="form-control">
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="birth_date">تاريخ الميلاد</label>
                                    <div class="input-group">
                                        <input type="text" name="birth_date[]" class="form-control drgpicker" id="birth_date" aria-describedby="button-addon">
                                        @error('birth_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="input-group-append">
                                            <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="text" name="phone[]" id="phone" class="form-control">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="address">العنوان</label>
                                    <input type="text" name="address[]" id="address" class="form-control">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="license_type">فئة الشهادة</label>
                                    <select class="form-control"  name="license_type[]" id="license_type">
                                        <option value="" disabled selected>اختر فئة الشهادة</option>
                                        @foreach($LicenseTypes as $type)
                                            <option value="{{ $type }}" {{ old('license_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                    @error('license_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="license_expiration_date">تاريخ انتهاء الشهادة</label>
                                    <div class="input-group">
                                        <input type="text" name="license_expiration_date[]" class="form-control drgpicker" id="license_expiration_date" aria-describedby="button-addon">
                                        @error('license_expiration_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="input-group-append">
                                            <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col mr-auto mb-5 mt-5">
                            <div class="ml-auto">
                            </div>
                            <div class="dropdown">
                                <button type="submit" class="btn btn-success rounded-btn">حفظ</button>
                                <button type="button" id="add-form-btn" class="btn rounded-btn btn-primary">إضافة سائق آخر</button>
                                <button type="button" class="btn btn-danger rounded-btn delete-form-btn">حذف هذا السائق</button>
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
        input.value = '';
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
            } else {
                button.style.display = 'inline-block';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        checkDeleteButtonVisibility();
    });
    
</script>

@endsection
