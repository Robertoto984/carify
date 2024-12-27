@extends('dashboard')
@section('content')

<div class="col-12">
    <h2 class="page-title mb-3">بطاقة مورّد</h2>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{route('suppliers.store')}}" class="submit-form">
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
                                <label for="trade_name">الاسم التجاري</label>
                                <input type="text" name="trade_name[]" id="trade_name" class="form-control">
                                <span class="text-danger" id="trade_name-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="address">العنوان</label>
                                <input type="text" name="address[]" id="address" class="form-control">
                                <span class="text-danger" id="address-error"></span>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="text" name="email[]" id="email" class="form-control">
                                <span class="text-danger" id="email-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="phone_1">رقم الهاتف 1</label>
                                <input type="text" name="phone_1[]" id="phone_1" class="form-control">
                                <span class="text-danger" id="phone_1-error"></span>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="phone_2">رقم الهاتف 2</label>
                                <input type="text" name="phone_2[]" id="phone_2" class="form-control">
                                <span class="text-danger" id="phone_2-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="notes">ملاحظات</label>
                                    <textarea class="form-control" id="notes" name="notes[]" rows="4"></textarea>
                                    <span class="text-danger" id="notes-error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col mr-auto mb-5 mt-5">
                            <div class="dropdown">
                                <button type="submit" class="btn btn-success rounded-btn">حفظ</button>
                                <button type="button" id="add-form-btn" class="btn rounded-btn btn-primary">إضافة مورّد
                                    آخر</button>
                                <button type="button" class="btn btn-danger rounded-btn delete-form-btn">إلغاء هذا
                                    المورّد</button>
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