<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Details</title>
    
    <!-- Include Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
{{-- <div>
        <h1>Department Details</h1>

    @foreach ($exams as $exam)
        <h2>Department: {{ $exam->exam_department }}</h2>
        <h3>Session Year: {{ $exam->session_year }}</h3>
    @endforeach
</div> --}}
    <div class="container mt-5">
        <h2 class="text-center">Bill Details</h2>
        
        <!-- Table to display bill details -->
        <div class="table-responsive mt-4">
            <table class="table table-hover table-striped table-bordered align-middle">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Billing Sector</th>
                        <th>Course Code</th>
                        <th>Count</th>
                        <th>Paper Type</th>
                        <th>Rate</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($billDetails as $bill)
                    <tr>
                        <td class="text-center">{{ $bill->id }}</td>
                        <td>{{ $bill->billingSector->billing_sector_name ?? 'N/A' }}</td>
                        <td>{{ $bill->course_code }}</td>
                        <td class="text-center">{{ $bill->count }}</td>
                        <td>{{ $bill->is_full_paper ? 'Full Paper' : 'Half Paper' }}</td>
                        <td class="text-end">{{ number_format($bill->rate, 2) }}</td>
                        <td class="text-end">{{ number_format($bill->count * $bill->rate, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        
    </div>

    <!-- Include Bootstrap JS for interactive table (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
