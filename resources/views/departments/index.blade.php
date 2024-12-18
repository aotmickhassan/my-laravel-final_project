<!-- resources/views/departments/department.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Department Menu</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.7.0/css/autoFill.dataTables.min.css" />

    <script  src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.7.0/js/dataTables.autoFill.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Department and Session Selection</h2>
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

            <!-- Add Billing Sector Dropdown Button -->
            <div class="flex justify-content-center full-width ">
                <button type="button" id="addField" class="btn btn-primary">Add Billing Sector</button>
            </div>
            <!-- Billing Sector Selection -->
            <div id = "billingSectorsList">
            <div id="container" class="form-group">
                <table id="billTable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 5%">Sl</th>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 20%;">Course No</th>
                        <th style="width: 5%">No of Script/Student/Days</th>
                        <th style="width: 10%">Full Paper/Half Paper</th>
                        <th style="width: 15%">Rate</th>
                        <th style="width: 15%">Total Amount</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                <div id="totalAmountDisplay" class="mt-3">
                    <h4 style="align-content: left">Total Amount: <span id="totalAmount" class="text-success">0</span></h4>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" id="saveData" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Save Data
                    </button>
                </div>
                <div class="d-flex justify-content-left">
                    <a href="{{ route('billDetail.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-eye"></i> View Bill Details
                    </a>
                </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
        const billTable = $('#billTable').DataTable();
        let count = 1;
    
        // Function to get already selected billing sector IDs
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
    
        // Add a new field
        $('#addField').click(function () {
                $.ajax({
                url: "{{ route('billingSectorFetch.data') }}", // Laravel route to fetch billing sectors
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.length > 0) {
                        const selectedIds = getSelectedBillingSectors(); // Get already selected IDs
                        let optionsHTML = `<option value="">--Select Billing Sector--</option>`;
                        data.forEach(sector => {
                            if (!selectedIds.includes(sector.id.toString())) { // Add only unselected options
                                optionsHTML += `<option value="${sector.id}">${sector.billing_sector_name}</option>`;
                            }
                        });
    
                        // Add the new row
                        billTable.row.add([
                            count,
                            `<select class="form-control" id="billSector" name="billing_sector[]">
                                ${optionsHTML}
                            </select>`,
                            `<input type="text" class="form-control" id="course_no" name="course_no[]" placeholder="Enter Course No">`,
                            `<input type="number" class="form-control scripts" id="count" name="scripts[]" value="1" placeholder="Enter No of Scripts" min="1">`,
                            `<select class="form-control" id="paper" name="paper_type[]">
                                <option value="1">Full Paper</option>
                                <option value="0">Half Paper</option>
                            </select>`,
                            `<input type="number" class="form-control rate" id="rate" name="rate[]" placeholder="Enter Rate">`,
                            `<input type="number" class="form-control total-amount" name="total_amount[]" placeholder="Total Amount" readonly>`,
                            `<button type="button" class="btn btn-danger removeRow">Remove</button>`
                            // `<button type="button" class="btn btn-secondary saveRow">Save</button>`
                        ]).draw(false);
    
                        count++;
                    } else {
                        console.error('No billing sectors available to add.');
                    }
                },
                error: function (error) {
                    console.error('Error fetching billing sectors:', error);
                }
            });
        });
    
        // Remove a row
        $('#billTable tbody').on('click', '.removeRow', function () {
            billTable.row($(this).closest('tr')).remove().draw(false);
    
            let currentRows = billTable.rows().nodes();
            $(currentRows).each(function (index, row) {
                $(row).find('td:first').text(index + 1);
            });
    
            count--;
            calculateTotalAmount();
        });
    
        // Calculate total amount
        function calculateTotalAmount() {
            let totalAmount = 0;
    
            $('#billTable tbody tr').each(function () {
                const scripts = parseFloat($(this).find('.scripts').val()) || 1;
                const rate = parseFloat($(this).find('.rate').val());
    
                if (!isNaN(rate) && rate > 0) {
                    const rowTotal = scripts * rate;
                    $(this).find('.total-amount').val(rowTotal.toFixed(2));
                    totalAmount += rowTotal;
                } else {
                    $(this).find('.total-amount').val('');
                }
            });
    
            $('#totalAmount').text(totalAmount.toFixed(2));
        }
    
        // Recalculate total amount on input
        $('#billTable tbody').on('input', '.scripts, .rate', function () {
            calculateTotalAmount();
        });
        });
    </script>
<script>
    $('#saveData').click(function () {
    const tableData = [];
    $('#billTable tbody tr').each(function () {
        const row = {
            billing_sector: $(this).find('select[name="billing_sector[]"]').val(),
            course_code: $(this).find('input[name="course_no[]"]').val(),
            count: $(this).find('input[name="scripts[]"]').val(),
            paper_type: $(this).find('select[name="paper_type[]"]').val(),
            rate: $(this).find('input[name="rate[]"]').val(),
            bill_id: 1 // Replace with dynamic bill_id if needed
        };

        // Only add rows with valid billing sector and rate
        if (row.billing_sector && row.rate) {
            tableData.push(row);
        }
    });

    // Ensure there's data to save
    if (tableData.length === 0) {
        alert('No data to save!');
        return;
    }

    // AJAX POST request to save the data
    $.ajax({
        url: "{{ route('billDetailSave.data') }}",
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { tableData: tableData },
        success: function (response) {
            alert(response.message);
            // Optionally, reset the table
            // $('#billTable').DataTable().clear().draw();
        },
        error: function (xhr) {
            console.error('Error response:', xhr.responseText);
            alert('Failed to save the ajax post data. Please try again.');
        }
    });
    });
</script>
</body>
</html>
