


<form method="POST" action="{{route('users.update',['id'=>$row->id])}}" class="submit-form">
    @csrf
    <div id="vehicle-forms-container">
        <div class="vehicle-form">
            <div class="row">

                <div class="col-md-6 form-group mb-3">
                    <label for="name">الاسم</label>
                    <input type="text" name="name" id="name" value="{{ $row->name }}" class="form-control">

                    <span class="text-danger" id="name-error"></span>


                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="email">الايميل</label>
                    <input type="email" name="email" value="{{ $row->email }}" id="email" class="form-control">

                    <span class="text-danger" id="email-error"></span>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="password">كلمة المرور</label>
                    <input type="password" name="password" id="plate_number" class="form-control">

                    <span class="text-danger" id="password-error"></span>

                </div>

                <div class="col-md-6 form-group mb-3">
                    <label for="role_id">الوظيفة</label>
                    <select class="form-control" id="role_id" name="role_id">
                        <option value="" disabled selected> الوظيفة</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $role->id == $row->role_id ? 'selected':'' }}>{{ $role->name
                            }}</option>
                        @endforeach
                    </select>

                    <span class="text-danger" id="role_id-error"></span>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-btn" data-dismiss="modal">إغلاق</button>
                <button type="submit" class="btn btn-success rounded-btn">حفظ</button>
            </div>
        </div>
    </div>
</form>