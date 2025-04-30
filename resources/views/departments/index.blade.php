@extends('layouts.main')

@section('title', 'Course')

@section('content')

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.7.0/css/autoFill.dataTables.min.css" />

<!-- jQuery and DataTables Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/autofill/2.7.0/js/dataTables.autoFill.min.js"></script>

<style>
    #billTable .form-control{
        margin-bottom: 0!important;
        font-size: 13px;
        padding: 5px;
    }
</style>



<div class="content-layout">
    {{-- <h2 class="m-3 p-2" style="text-align: center">Teachers Table</h2> --}}
    <div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-between mb-2">
        <p class="m-0" style="font-weight: 600; font-size: 20px;">Department and Session Selection</p>
        {{-- <a href="{{ route('teacher.create') }}" class="btn btn-sm btn-outline-success ">Add Teacher</a> --}}
    </div>

    {{-- MAIN-SECTION-PARTS --}}
    <div class="">
        <form>
            <!-- Department Selection -->
            <div class="form-group">
                <label for="dropdown">Select a Department:</label>
                <select id="dropdown" name="department" class="form-control">
                    <option value="">--Select a Department--</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Session Selection -->
            <div class="form-group">
                <label for="session">Select Session:</label>
                <select name="session" id="session" class="form-control">
                    <option value="">--Select Session--</option>
                    <option value="2020">2020-2021</option>
                    <option value="2021">2021-2022</option>
                    <option value="2022">2022-2023</option>
                    <option value="2023">2023-2024</option>
                    <option value="2024">2024-2025</option>
                </select>
            </div>
            <!-- Add Billing Sector Button -->
            <div class="text-left mb-3">
                <button type="button" id="addField" class="btn btn-sm btn-success">Add Billing Sector</button>
            </div>

            <hr>

            <!-- Billing Sectors Table -->
            <div id="billingSectorsList">
                <table id="billTable" class="table table-hover table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th style="width: 5%; justify-items: center ;">Sl</th>
                            <th style="width: 25%;">Name</th> <!-- Wider -->
                            <th style="width: 20%;">Course No</th> <!-- Wider -->
                            <th style="width: 10%;">No of Script/<br/>Student/Days</th> <!-- Smaller -->
                            <th style="width: 5%;">Full Paper/Half Paper</th> <!-- Smaller -->
                            <th style="width: 10%;">Rate</th>
                            <th style="width: 10%;">Qty</th>
                            <th style="width: 15%;">Amount</th>
                            <th style="width: 5%;">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <!-- Total Amount Display -->
                <div id="totalAmountDisplay" class="mt-3">
                    <h4>Total Amount: <span id="totalAmount" class="text-success">0</span></h4>
                </div>

                <hr>
                <!-- Save and View Buttons -->
                <div class="d-flex justify-content-start">
                    <button type="button" id="saveData" class="btn btn btn-success">
                        <i class="fas fa-save"></i> Save Data
                    </button>
                </div>

            </div>
        </form>
    </div>
    {{-- MAIN-SECTION-PARTS --}}
</div>

<script>
    $(document).ready(function () {
        // const billTable = $('#billTable').DataTable();
        const billTable = $('#billTable').DataTable({
            paging: false,        // hides pagination
            searching: false,     // hides search box
            info: false,          // hides "Showing X of Y entries" text
            lengthChange: false   // hides the "Show N entries" dropdown
        });
        let count = 1;

        // Function to get already selected billing sectors
        function getSelectedBillingSectors() {
            const selectedIds = [];
            $('#billTable tbody tr').each(function () {
                const selectedValue = $(this).find('select[name="billing_sector[]"]').val();
                if (selectedValue) {
                    selectedIds.push(selectedValue);
                }
            });
            return selectedIds;
        }

        // Add new billing sector row
        $('#addField').click(function () {
            $.ajax({
                url: "{{ route('billingSectorFetch.data') }}",
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.billingSectors.length > 0 && data.courses.length > 0) {

                        const selectedIds = getSelectedBillingSectors();

                        let optionsHTML = `<option value="">--Select Billing Sector--</option>`;
                        let courseOptions = `<option value="">--Select Course--</option>`;
                        data.courses.forEach(course => {
                            courseOptions += `<option value="${course.id}">${course.course_code}</option>`;
                        });

                        data.billingSectors.forEach(sector => {
                            if (!selectedIds.includes(sector.id.toString())) {
                                optionsHTML += `<option value="${sector.id}">${sector.billing_sector_name}</option>`;
                            }
                        });

                        billTable.row.add([
                            count,
                            `<select class="form-control" name="billing_sector[]">${optionsHTML}</select>`,
                            `<select class="form-control"name="course_no[]">${courseOptions}</select>`,
                            `<input type="number" class="form-control scripts" name="scripts[]" value="1" min="1">`,
                            `<select class="form-control paper_type" name="paper_type[]">
                                <option value="1">Full Paper</option>
                                <option value="0">Half Paper</option>
                            </select>`,
                            `<input type="number" class="form-control rate" name="rate[]" placeholder="Rate">`,
                            `<input type="number" class="form-control quantity" name="quantity[]" value="1" min="1" max="3">`,
                            `<input type="number" class="form-control total-amount" name="total_amount[]" placeholder="Total" readonly>`,
                            `<button type="button" class="btn btn-sm btn-outline-danger removeRow m-0">Remove</button>`
                        ]).draw(false);

                        count++;
                    } else {
                        console.error('No billing sectors available.');
                    }
                },
                error: function (error) {
                    console.error('Error fetching billing sectors:', error);
                }
            });
        });

        // Update totals when inputs change
        $('#billTable tbody').on('input', '.scripts, .rate, .quantity', function () {
            calculateTotalAmount();
        });

        // Calculate total amount
        function calculateTotalAmount() {
            let totalAmount = 0;

            $('#billTable tbody tr').each(function () {
                const scripts = parseFloat($(this).find('.scripts').val()) || 1;
                const rate = parseFloat($(this).find('.rate').val()) || 0;
                const quantity = parseFloat($(this).find('.quantity').val()) || 1;

                if (!isNaN(rate) && !isNaN(scripts) && !isNaN(quantity)) {
                    const rowTotal = scripts * rate * quantity;
                    $(this).find('.total-amount').val(rowTotal.toFixed(2));
                    totalAmount += rowTotal;
                } else {
                    $(this).find('.total-amount').val('');
                }
            });

            $('#totalAmount').text(totalAmount.toFixed(2));
        }

        // Remove row and reindex Sl numbers
        $('#billTable tbody').on('click', '.removeRow', function () {
            billTable.row($(this).closest('tr')).remove().draw(false);

            $('#billTable tbody tr').each(function (index, row) {
                $(row).find('td:first').text(index + 1);
            });

            count = $('#billTable tbody tr').length + 1;

            calculateTotalAmount();
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Save data to server when Save button clicked
        $('#saveData').click(function () {
            const tableData = [];
            $('#billTable tbody tr').each(function () {
                const row = {
                    billing_sector: $(this).find('select[name="billing_sector[]"]').val(),
                    course_code: $(this).find('select[name="course_no[]"]').val(),
                    quantity: $(this).find('input[name="quantity[]"]').val(),
                    count: $(this).find('input[name="scripts[]"]').val(),
                    paper_type: $(this).find('select[name="paper_type[]"]').val(),
                    rate: $(this).find('input[name="rate[]"]').val(),
                    bill_id: 1 // You can dynamically assign it if needed
                };

                if (row.billing_sector && row.rate) {
                    tableData.push(row);
                }
            });

            if (tableData.length === 0) {
                alert('No data to save!');
                return;
            }

            $.ajax({
                url: "{{ route('billDetailSave.data') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { tableData: tableData },
                success: function (response) {
                    console.log(response);
                    alert(response.message);
                    location.href = "{{ route('bills.index') }}"; // Redirect to the index page
                    // Optionally clear table after save
                    // $('#billTable').DataTable().clear().draw();
                },
                error: function (xhr) {
                    console.error('Error response:', xhr.responseText);
                    alert('Failed to save data. Please try again.');
                }
            });
        });
    });
</script>

@endsection

