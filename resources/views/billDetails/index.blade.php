@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="content-layout">
    {{-- <h2 class="m-3 p-2" style="text-align: center">Teachers Table</h2> --}}
    <div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    </div>
<div class="container my-3">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light py-2">
            <h6 class="card-title fw-semibold text-dark mb-0 small"> Bill Details</h6>
        </div>
        <div class="card-body p-3">
            <div class="row row-cols-1 row-cols-md-2 g-3">
                <!-- Left Column -->
                <div class="col">
                    <div class="mb-2">
                        <h6 class="text-muted fw-normal text-uppercase small mb-1">Created By</h6>
                        <p class="mb-0 small">{{ $creator }}</p>
                    </div>
                    <div class="mb-2">
                        <h6 class="text-muted fw-normal text-uppercase small mb-1">Address</h6>
                        <p class="mb-0 small">{{ $address ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-2">
                        <h6 class="text-muted fw-normal text-uppercase small mb-1">Department</h6>
                        <p class="mb-0 small">{{ $dept }}</p>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="col">
                    <div class="mb-2">
                        <h6 class="text-muted fw-normal text-uppercase small mb-1">Exam Department</h6>
                        <p class="mb-0 small">{{ $exam_dept ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-2">
                        <h6 class="text-muted fw-normal text-uppercase small mb-1">Academic Session</h6>
                        <p class="mb-0 small">{{ $session }} (Year: {{ $year ?? 'N/A' }}, Sem: {{ $semester ?? 'N/A' }})</p>
                    </div>
                    <div class="mb-2">
                        <h6 class="text-muted fw-normal text-uppercase small mb-1">Exam Period</h6>
                        @if($exam_start_date && $exam_end_date)
                            <p class="mb-0 small">
                                <span class="fw-medium">From:</span> {{ \Carbon\Carbon::parse($exam_start_date)->format('M j, Y') }} 
                                <span class="fw-medium mx-1">to</span> 
                                {{ \Carbon\Carbon::parse($exam_end_date)->format('M j, Y') }}
                            </p>
                        @else
                            <p class="mb-0 small text-muted">N/A</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

    {{-- MAIN-SECTION-PARTS --}}
    <div class="container p-0">

        <!-- Table to display bill details -->
        <div class="table-responsive ">
            <table class="table table-hover table-striped table-bordered align-middle">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Billing Sector</th>
                        <th>Course Code</th>
                        <th>Count</th>
                        <th>Paper Type</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($billDetails as $bill)
                    <tr>
                        <td class="text-center">{{ $bill->id }}</td>
                        <td>{{ $bill->billingSector->billing_sector_name ?? 'N/A' }}</td>
                        <td>{{ $bill->course->course_code }}</td>
                        <td class="text-center">{{ $bill->count }}</td>
                        <td>{{ $bill->is_full_paper ? 'Full Paper' : 'Half Paper' }}</td>
                        <td class="text-center">{{ number_format($bill->rate, 2) }}</td>
                        <td class="text-center">{{ $bill->quantity }}</td>
                        <td class="text-left">
                            {{ number_format($bill->count * $bill->rate * $bill->quantity, 2) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7" class="text-end"><strong>Total Amount:</strong></td>
                        <td class="text-start">
                            <strong class="text-success">
                                {{ number_format($billDetails->sum(function($bill) {
                                    return $bill->count * $bill->rate * $bill->quantity;
                                }), 2) }}
                            </strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    {{-- MAIN-SECTION-PARTS --}}
</div>
@endsection




