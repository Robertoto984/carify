@extends('dashboard')
@section('content')

<div class="col-12">
    <h2 class="page-title mb-3">بطاقة مسخدم</h2>
    <div class="card shadow mb-4">
        <div class="card-body">


            <form method="POST" action="{{route('users.store')}}" class="submit-form">
                @csrf
                <div id="vehicle-forms-container">
                    <div class="vehicle-form">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="name">الاسم</label>
                                <input type="text" name="name[]" id="name" class="form-control">

                                <span class="text-danger" id="name-error"></span>


                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="email">الايميل</label>
                                <input type="email" name="email[]" id="email" class="form-control">

                                <span class="text-danger" id="email-error"></span>

                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="password">كلمة المرور</label>
                                    <input type="password" name="password[]" id="plate_number" class="form-control">

                                    <span class="text-danger" id="password-error"></span>

                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="role_id">الوظيفة</label>
                                    <select class="form-control" id="role_id" name="role_id[]">
                                        <option value="" disabled selected> الوظيفة</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>

                                    <span class="text-danger" id="role_id-error"></span>

                                </div>
                            </div>

                        <div class="col mr-auto mb-5 mt-5">
                            <div class="dropdown">
                                <button type="submit" class="btn btn-success rounded-btn">حفظ</button>
                                <button type="button" id="add-form-btn" class="btn rounded-btn btn-primary">إضافة مستخدم
                                    اخر</button>
                                <button type="button" class="btn btn-danger rounded-btn delete-form-btn">إلغاء هذه
                                    المستخدم</button>
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