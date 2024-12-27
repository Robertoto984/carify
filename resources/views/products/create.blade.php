@extends('dashboard')
@section('content')

<div class="col-12">
    <h2 class="page-title mb-3">بطاقة مادة</h2>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{route('products.store')}}" class="submit-form">
                @csrf
                <div id="vehicle-forms-container">
                    <div class="vehicle-form">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="code">الرمز</label>
                                <input type="text" name="code[]" id="code" class="form-control">
                                <span class="text-danger" id="code-error"></span>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="name">الاسم</label>
                                <input type="text" name="name[]" id="name" class="form-control">
                                <span class="text-danger" id="name-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="qty">الكمية</label>
                                <input type="number" name="qty[]" id="qty" class="form-control">
                                <span class="text-danger" id="qty-error"></span>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="origin_country">بلد المنشأ</label>
                                <input type="text" name="origin_country[]" id="origin_country" class="form-control">
                                <span class="text-danger" id="origin_country-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="prod_date">تاريخ الإنتاج</label>
                                <input type="date" name="prod_date[]" id="prod_date" class="form-control">
                                <span class="text-danger" id="prod_date-error"></span>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="exp_date">تاريخ الانتهاء</label>
                                <input type="date" name="exp_date[]" id="exp_date" class="form-control">
                                <span class="text-danger" id="exp_date-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="supplier_id">المورّد</label>
                                <select class="form-control" id="supplier_id" name="supplier_id[]">
                                    <option value="" disabled selected>اختر المورّد</option>
                                    @foreach($suppliers as $supp)
                                        <option value="{{ $supp->id }}">{{ $supp->trade_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="supplier_id-error"></span>
                            </div>
                            <div class="col-md-6">
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
                                <button type="button" id="add-form-btn" class="btn rounded-btn btn-primary">إضافة مادة
                                    أخرى</button>
                                <button type="button" class="btn btn-danger rounded-btn delete-form-btn">إلغاء هذه
                                    المادة</button>
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