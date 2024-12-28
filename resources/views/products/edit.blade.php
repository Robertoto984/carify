<form method="POST" action="{{route('products.update',['id'=>$row->id])}}" class="submit-form">
    @csrf
    <div id="vehicle-forms-container">
        <div class="vehicle-form">
            <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="code">الرمز</label>
                                <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $row->code) }}">
                                <span class="text-danger" id="code-error"></span>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="name">الاسم</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $row->name) }}">
                                <span class="text-danger" id="name-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="qty">الكمية</label>
                                <input type="number" name="qty" id="qty" class="form-control" value="{{ old('qty', $row->qty) }}">
                                <span class="text-danger" id="qty-error"></span>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="price">السعر</label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $row->price) }}">
                                <span class="text-danger" id="price-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="prod_date">تاريخ الإنتاج</label>
                                <input type="date" name="prod_date" id="prod_date" class="form-control" value="{{ old('produvtion_date', $row->production_date) }}">
                                <span class="text-danger" id="prod_date-error"></span>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="exp_date">تاريخ الانتهاء</label>
                                <input type="date" name="exp_date" id="exp_date" class="form-control" value="{{ old('expireation_date', $row->expireation_date) }}">
                                <span class="text-danger" id="exp_date-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="supplier_id">المورّد</label>
                                <select class="form-control" id="supplier_id" name="supplier_id">
                                    <option value="" disabled {{ old('supplier_id') ? '' : 'selected' }}>اختر المورّد</option>
                                    @foreach($suppliers as $supp)
                                        <option value="{{ $supp->id }}" 
                                            {{ old('supplier_id', $row->supplier_id) == $supp->id ? 'selected' : '' }}>
                                            {{ $supp->trade_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="supplier_id-error"></span>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="origin_country">بلد المنشأ</label>
                                <input type="text" name="origin_country" id="origin_country" class="form-control" value="{{ old('origin_country', $row->origin_country) }}">
                                <span class="text-danger" id="origin_country-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="notes">ملاحظات</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="4" value="{{ old('notes', $row->notes) }}"></textarea>
                                    <span class="text-danger" id="notes-error"></span>
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