@extends('dashboard')
@section('content')

<div class="col-12">
    <h2 class="page-title mb-3">إضافة نوع صيانة</h2>
    <div class="card shadow mb-4">
        <div class="card-body">


            <form method="POST" action="{{route('maintenance.store')}}" class="submit-form">
                @csrf
                <div id="vehicle-forms-container">
                    <div class="vehicle-form">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="name">النوع</label>
                                <input type="text" name="name[]" id="name" class="form-control">
                                <span class="text-danger" id="name-error"></span>
                            </div>
                        </div>


                        <div class="col mr-auto mb-5 mt-5">
                            <div class="dropdown">
                                <button type="submit" class="btn btn-success rounded-btn">حفظ</button>
                                <button type="button" id="add-form-btn" class="btn rounded-btn btn-primary">إضافة نوع
                                    اخر</button>
                                <button type="button" class="btn btn-danger rounded-btn delete-form-btn">إلغاء هذا
                                    النوع</button>
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