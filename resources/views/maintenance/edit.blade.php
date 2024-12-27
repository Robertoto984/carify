<form method="POST" action="{{route('maintenance.update',['id'=>$row->id])}}" class="submit-form">
    @csrf
    <div id="vehicle-forms-container">
        <div class="vehicle-form">
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="name">تعديل النوع</label>
                    <input type="text" name="name" id="name" value="{{ $row->name }}" class="form-control">
                    <span class="text-danger" id="name-error"></span>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-btn" data-dismiss="modal">إغلاق</button>
                <button type="submit" class="btn btn-success rounded-btn">حفظ</button>
            </div>
        </div>
    </div>
</form>