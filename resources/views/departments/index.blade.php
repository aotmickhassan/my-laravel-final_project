<!-- resources/views/departments/department.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Menu</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" />
    <script  src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css"></script>
    

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
                        <th style="width: 15%;">Name</th>
                        <th style="width: 15%;">Course No</th>
                        <th style="width: 15%">No of Script/Student/Days</th>
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
                
            </div>
            
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            // Initialize DataTable and store the instance
            const billTable = $('#billTable').DataTable();
    
            // Initialize a counter for row numbering
            let count = 1;
    
            // Add a new row on button click
            $('#addField').click(function() {
                // Fetch billing sectors from the server
                $.ajax({
                    url: "{{ route('billingSectorFetch.data') }}", // Laravel route to fetch billing sectors
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.length > 0) {
                            // Generate the dropdown options from the fetched data
                            let optionsHTML = `<option value="">--Select Billing Sector--</option>`;
                            data.forEach(sector => {
                                optionsHTML += `<option value="${sector.id}">${sector.billing_sector_name}</option>`;
                            });
    
                            // Add a row to the DataTable
                            billTable.row.add([
                                count, // Serial number
                                `<select class="form-control" name="billing_sector[]">
                                    ${optionsHTML}
                                </select>`,
                                `<input type="text" class="form-control" name="course_no[]" placeholder="Enter Course No">`,
                                `<input type="number" class="form-control" name="scripts[]" placeholder="Enter No of Scripts">`,
                                `<select class="form-control" name="paper_type[]">
                                    <option value="full">Full Paper</option>
                                    <option value="half">Half Paper</option>
                                </select>`,
                                `<input type="number" class="form-control rate" name="rate[]" placeholder="Enter Rate">`,
                                `<input type="number" class="form-control total-amount" name="total_amount[]" placeholder="Enter Total Amount">`,
                                `<button type="button" class="btn btn-danger removeRow">Remove</button>`
                            ]).draw(false); // Draw the table to update the UI
    
                            // Increment the counter for the next row
                            count++;
                        } else {
                            console.error('No billing sectors available to add.');
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching billing sectors:', error);
                    }
                });
            });
    
            // Event delegation to handle row removal
            $('#billTable tbody').on('click', '.removeRow', function() {
                // Remove the row from DataTable
                billTable.row($(this).closest('tr')).remove().draw(false);
    
                // Recalculate serial numbers after a row is removed
                let currentRows = billTable.rows().nodes();
                $(currentRows).each(function(index, row) {
                    $(row).find('td:first').text(index + 1); // Update the serial number column
                });
    
                // Decrement the counter for serial numbers
                count--;
    
                // Update total amount after row removal
                calculateTotalAmount();
            });
    
            // Calculate the total amount function
            function calculateTotalAmount() {
                let totalAmount = 0;
    
                // Loop through all rows and sum up the values in the 'Total Amount' column
                $('#billTable tbody .total-amount').each(function() {
                    let value = parseFloat($(this).val());
                    if (!isNaN(value)) {
                        totalAmount += value;
                    }
                });
    
                // Update the total amount display
                $('#totalAmount').text(totalAmount.toFixed(2));
            }
    
            // Recalculate the total amount when any 'Total Amount' input changes
            $('#billTable tbody').on('input', '.total-amount', function() {
                calculateTotalAmount();
            });
        });
    </script>  
</body>
</html>
