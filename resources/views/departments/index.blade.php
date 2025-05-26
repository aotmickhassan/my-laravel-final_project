@extends('layouts.main')

@section('title', 'Course')

@section('content')

<!-- Bootstrap CSS (needed for grid) -->
<link
  rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
/>

<!-- DataTables CSS -->
<link
  rel="stylesheet"
  href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css"
/>
<link
  rel="stylesheet"
  href="https://cdn.datatables.net/autofill/2.7.0/css/autoFill.dataTables.min.css"
/>

<!-- CSRF token for AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
  #billTable .form-control {
    margin-bottom: 0 !important;
    font-size: 13px;
    padding: 5px;
  }
</style>

<div class="content-layout p-3">
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <h5 class="mb-4">Department and Session Selection</h5>

  <form>
    <div class="row">
      <!-- Department -->
      <div class="col-md-6 mb-3">
        <label for="dropdown">Select Department</label>
        <select id="dropdown" name="department" class="form-control">
          <option value="{{ Auth::user()->dept }}" selected>
            {{ Auth::user()->department->name ?? '--Select Department--' }}
          </option>
          @foreach ($departments as $dpt)
            @if ($dpt->id != Auth::user()->dept)
              <option disabled value="{{ $dpt->id }}">{{ $dpt->name }}</option>
            @endif
          @endforeach
        </select>
      </div>

      <!-- Session -->
      <div class="col-md-6 mb-3">
        <label for="session">Select Session</label>
        <select name="session" id="session" class="form-control">
          <option value="">--Select Session--</option>
          <option value="2020">2020-2021</option>
          <option value="2021">2021-2022</option>
          <option value="2022">2022-2023</option>
          <option value="2023">2023-2024</option>
          <option value="2024">2024-2025</option>
        </select>
      </div>

      <!-- Exam Department -->
      <div class="col-md-6 mb-3">
        <label for="exam_dept">Exam Department</label>
        <select name="exam_dept" id="exam_dept" class="form-control">
          <option value="">--Select Exam Department--</option>
          @foreach ($departments as $dpt)
            <option value="{{ $dpt->name }}">{{ $dpt->name }}</option>
          @endforeach
        </select>
      </div>

        <!-- Exam Year -->
        <div class="col-md-6 mb-3">
        <label for="year">Year</label>
        <select name="year" id="year" class="form-control">
            <option value="">--Select Year--</option>
            <option value="1">1st</option>
            <option value="2">2nd</option>
            <option value="3">3rd</option>
            <option value="4">4th</option>
        </select>
        </div>



      <!-- Semester -->
      <div class="col-md-6 mb-3">
        <label for="semester">Semester</label>
        <select name="semester" id="semester" class="form-control">
          <option value="">--Select Semester--</option>
          <option value="1">1st</option>
          <option value="2">2nd</option>
        </select>
      </div>

      <!-- Exam Start Date -->
      <div class="col-md-3 mb-3">
        <label for="exam_start_date">Start Date</label>
        <input
          type="date"
          name="exam_start_date"
          id="exam_start_date"
          class="form-control"
        />
      </div>

      <!-- Exam End Date -->
      <div class="col-md-3 mb-3">
        <label for="exam_end_date">End Date</label>
        <input
          type="date"
          name="exam_end_date"
          id="exam_end_date"
          class="form-control"
        />
      </div>
    </div>

    <!-- Add Billing Sector -->
    <div class="mb-3">
      <button type="button" id="addField" class="btn btn-sm btn-success">
        Add Billing Sector
      </button>
    </div>

    <hr />

    <!-- Billing Table -->
    <div id="billingSectorsList">
      <table
        id="billTable"
        class="table table-hover table-striped table-bordered align-middle"
      >
        <thead>
          <tr>
            <th style="width:5%">Sl</th>
            <th style="width:25%">Name</th>
            <th style="width:20%">Course No</th>
            <th style="width:10%">Scripts/Days</th>
            <th style="width:5%">Paper</th>
            <th style="width:10%">Rate</th>
            <th style="width:10%">Qty</th>
            <th style="width:15%">Amount</th>
            <th style="width:5%">Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>

      <div class="mt-3">
        <h5>
          Total Amount:
          <span id="totalAmount" class="text-success">0.00</span>
        </h5>
      </div>

      <hr />

      <button type="button" id="saveData" class="btn btn-success">
        <i class="fas fa-save"></i> Save Data
      </button>
    </div>
  </form>
</div>

<!-- jQuery, Bootstrap & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/autofill/2.7.0/js/dataTables.autoFill.min.js"></script>

<script>
  $(document).ready(function () {
    // Init DataTable with custom empty message
    const billTable = $('#billTable').DataTable({
      paging: false,
      searching: false,
      info: false,
      lengthChange: false,
      language: { emptyTable: "No data available." }
    });
    let count = 1;

    // Recalculate totals
    function calculateTotalAmount() {
      let total = 0;
      $('#billTable tbody tr').each(function () {
        const s = +$(this).find('.scripts').val() || 1;
        const r = +$(this).find('.rate').val() || 0;
        const q = +$(this).find('.quantity').val() || 1;
        const rowTotal = s * r * q;
        $(this).find('.total-amount').val(rowTotal.toFixed(2));
        total += rowTotal;
      });
      $('#totalAmount').text(total.toFixed(2));
    }

    // Add new billing-sector row
    $('#addField').click(function () {
      $.get("{{ route('billingSectorFetch.data') }}").done(data => {
        if (!data.billingSectors.length || !data.courses.length) return;

        // Prevent duplicates
        const used = billTable.rows().data()
          .toArray()
          .map(row => $('select', row[1]).val());

        let sectorOpt = '<option value="">--Select Billing Sector--</option>';
        data.billingSectors.forEach(s => {
          if (!used.includes(String(s.id))) {
            sectorOpt += `<option value="${s.id}">${s.billing_sector_name}</option>`;
          }
        });

        let courseOpt = '<option value="">--Select Course--</option>';
        data.courses.forEach(c => {
          courseOpt += `<option value="${c.id}">${c.course_code}</option>`;
        });

        billTable.row.add([
          count,
          `<select class="form-control" name="billing_sector[]">${sectorOpt}</select>`,
          `<select class="form-control" name="course_no[]">${courseOpt}</select>`,
          `<input type="number" class="form-control scripts" name="scripts[]" value="1" min="1">`,
          `<select class="form-control paper_type" name="paper_type[]">
              <option value="1">Full</option>
              <option value="0">Half</option>
            </select>`,
          `<input type="number" class="form-control rate" name="rate[]" placeholder="Rate">`,
          `<input type="number" class="form-control quantity" name="quantity[]" value="1" min="1" max="3">`,
          `<input type="number" class="form-control total-amount" name="total_amount[]" readonly>`,
          `<button class="btn btn-sm btn-outline-danger removeRow">Remove</button>`
        ]).draw();
        count++;
      });
    });

    // Recalculate on input
    $('#billTable').on('input', '.scripts, .rate, .quantity', calculateTotalAmount);

    // Remove row, reindex, reset count, recalc, and show emptyTable if none
    $('#billTable').on('click', '.removeRow', function () {
      billTable.row($(this).closest('tr')).remove().draw();

      // Re-index remaining rows
      billTable.rows().every(function (idx) {
        $(this.node()).find('td:first').text(idx + 1);
      });

      // Reset count
      count = billTable.rows().count() + 1;

      calculateTotalAmount();
    });

$('#saveData').click(function () {
  const tableData = [];
  billTable.rows().every(function () {
    const $row = $(this.node());
    const data = {
      billing_sector: $row.find('select[name="billing_sector[]"]').val(),
      course_code: $row.find('select[name="course_no[]"]').val(),
      scripts: $row.find('.scripts').val(),
      paper_type: $row.find('.paper_type').val(),
      rate: $row.find('.rate').val(),
      count: $row.find('.scripts').val(), 
      quantity: $row.find('.quantity').val(),
      bill_id:1,
    };

    if (data.billing_sector && data.rate) {
      tableData.push(data);
    }
  });

  if (!tableData.length) {
    return alert('No data to save!');
  }

  $(this).prop('disabled', true);

  $.ajax({
    url: "{{ route('billDetailSave.data') }}",
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    data: {
      department: $('#dropdown').val(),
      session: $('#session').val(),
      exam_dept: $('#exam_dept').val(),
      year: $('#year').val(),
      semester: $('#semester').val(),
      exam_start_date: $('#exam_start_date').val(),
      exam_end_date: $('#exam_end_date').val(),
      tableData
    },
    success(resp) {
      alert(resp.message);
      window.location.href = "{{ route('bills.index') }}";
    },
    error(xhr) {
      $('#saveData').prop('disabled', false);
      console.error(xhr.responseText);
      alert('Failed to save data. Please try again.');
    }
  });
});

  });
</script>

@endsection
