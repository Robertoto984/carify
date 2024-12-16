<form method="POST" action="{{ route('drivers.update',['id'=>$row->id]) }}" class="submit-form" id="form-edit">
    @csrf

    <div id="vehicle-forms-container">
        <div class="vehicle-form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="first_name">الاسم الأول</label>
                        <input type="text" name="first_name" value="{{ $row->first_name }}" id="first_name"
                            class="form-control">
                        @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="last_name">الكنية</label>
                        <input type="text" name="last_name" value="{{ $row->last_name }}" id="last_name"
                            class="form-control">
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
                            <input type="text" name="birth_date" value="{{ $row->birth_date }}"
                                class="form-control drgpicker" id="birth_date" aria-describedby="button-addon">
                            @error('birth_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="input-group-append">
                                <div class="input-group-text" id="button-addon-date"><span
                                        class="fe fe-calendar fe-16"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="phone">رقم الهاتف</label>
                        <input type="text" name="phone" id="phone" value="{{ $row->phone }}" class="form-control">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="address">العنوان</label>
                        <input type="text" name="address" id="address" value="{{ $row->address }}" class="form-control">
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
                        <select class="form-control" name="license_type" id="license_type">
                            <option value="" disabled selected>اختر فئة الشهادة</option>
                            @foreach($LicenseTypes as $type)
                            <option value="{{ $type }}" {{ $row->license_type==$type ? 'selected' : ''
                                }}>{{ $type
                                }}</option>
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
                            <input type="text" name="license_expiration_date"
                                value="{{ $row->license_expiration_date }}" class="form-control drgpicker"
                                id="license_expiration_date" aria-describedby="button-addon">
                            @error('license_expiration_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="input-group-append">
                                <div class="input-group-text" id="button-addon-date"><span
                                        class="fe fe-calendar fe-16"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-btn" data-dismiss="modal">إغلاق</button>
                <button type="submit" class="btn btn-success rounded-btn">حفظ</button>
            </div>
        </div>
    </div>
</form>