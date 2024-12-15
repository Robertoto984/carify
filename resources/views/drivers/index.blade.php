@extends('dashboard')
@section('content')

<div class="col">
    <h2 class="mb-2 page-title">قائمة السائقين</h2>
</div>

<div class="col ml-auto">
    <div class="dropdown float-right">
        <a href="{{ route('drivers.create') }}" class="btn rounded-btn btn-primary">+ بطاقة سائق</a>
        <button id="bulkDeleteBtn" class="btn rounded-btn btn-danger ml-auto">حذف المحدد</button>
        <button class="btn rounded-btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> المزيد </button>
        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
            <a class="dropdown-item" href="#">Export</a>
            <a class="dropdown-item" href="#">Delete</a>
            <a class="dropdown-item" href="#">Something else here</a>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="row my-4">
        <div class="col-md-12">
            <div class="card shadow">
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

                    <table class="table datatables" id="dataTable-1">
                        <thead>
                            <tr>
                                <th>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="selectAll">
                                        <label class="custom-control-label" for="selectAll"></label>
                                    </div>
                                </th>
                                <th>#</th>
                                <th>الاسم الأول</th>
                                <th>الكنية</th>
                                <th>تاريخ الميلاد</th>
                                <th>رقم الهاتف</th>
                                <th>العنوان</th>
                                <th>فئة الشهادة</th>
                                <th>تاريخ انتهاء الشهادة</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($drivers as $driver)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input selectDriver" data-id="{{ $driver->id }}">
                                            <label class="custom-control-label"></label>
                                        </div>
                                    </td>
                                    <td>{{ $driver->id }}</td>
                                    <td>{{ $driver->first_name }}</td>
                                    <td>{{ $driver->last_name }}</td>
                                    <td>{{ $driver->birth_date }}</td>
                                    <td>{{ $driver->phone }}</td>
                                    <td>{{ $driver->address }}</td>
                                    <td>{{ $driver->license_type }}</td>
                                    <td>{{ $driver->license_expiration_date }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> تعديل
                                        </a>

                                        <button class="btn btn-danger btn-sm delete-driver" data-id="{{ $driver->id }}">
                                            <i class="fa fa-trash"></i> حذف
                                        </button>
                                    </td>
                                    <td>
                                        @foreach($driver->truckDeliverCards as $truckDeliverCard)
                                            @if($truckDeliverCard->truck)
                                                <p>{{ $truckDeliverCard->truck->manufacturer }} {{ $truckDeliverCard->truck->model }} (Plate: {{ $truckDeliverCard->truck->plate_number }})</p>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.selectDriver');

        // Update all checkboxes based on "Select All"
        selectAllCheckbox.addEventListener('change', function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateSelectAllState(); // Update the "Select All" state
        });

        // Update "Select All" checkbox state when individual checkboxes are clicked
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                updateSelectAllState();
            });
        });

        // Function to update "Select All" checkbox state
        function updateSelectAllState() {
            const totalCheckboxes = checkboxes.length;
            const checkedCheckboxes = document.querySelectorAll('.selectDriver:checked').length;

            if (checkedCheckboxes === totalCheckboxes) {
                selectAllCheckbox.checked = true;
                selectAllCheckbox.indeterminate = false;  // Clear indeterminate state
            } else if (checkedCheckboxes > 0 && checkedCheckboxes < totalCheckboxes) {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = true;  // Set indeterminate state
            } else {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = false;
            }
        }

        // Bulk delete functionality
        document.getElementById('bulkDeleteBtn').addEventListener('click', function () {
            const selectedDrivers = [];
            document.querySelectorAll('.selectDriver:checked').forEach(function (checkbox) {
                selectedDrivers.push(checkbox.getAttribute('data-id'));
            });

            if (selectedDrivers.length > 0) {
                if (confirm('Are you sure you want to delete the selected drivers?')) {
                    fetch('{{ route('drivers.bulkDelete') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ drivers: selectedDrivers })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Selected drivers have been deleted.');
                            location.reload();
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    });
                }
            } else {
                alert('Please select at least one driver to delete.');
            }
        });
    });
</script>

@endsection
