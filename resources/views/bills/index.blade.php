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
    <div class="d-flex justify-content-between mb-2">
        <p class="m-0" style="font-weight: 600; font-size: 20px;">Bills</p>
        {{-- <a href="{{ route('course.create') }}" class="btn btn-sm btn-outline-success ">Add Course</a> --}}
    </div>

    {{-- MAIN-SECTION-PARTS --}}
    <div class="container p-0">

        <!-- Table to display bill details -->
        <div class="table-responsive ">
            <table class="table table-hover table-striped table-bordered align-middle">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Bill Count</th>
                        <th>Bill Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bills as $bill)
                    <tr>
                        <td class="text-center">{{ $bill->id }}</td>
                        <td class="text-center">{{ $bill->billDetails->count() }}</td>
                        <td>
                            {{ number_format($bill->billDetails->sum(function($bill) {
                                return $bill->count * $bill->rate * $bill->quantity;
                            }), 2) }}
                        </td>
                        {{-- <td>{{ $bill->billingSector->billing_sector_name ?? 'N/A' }}</td>
                        <td>{{ $bill->course_code }}</td>
                        <td class="text-center">{{ $bill->count }}</td>
                        <td>{{ $bill->is_full_paper ? 'Full Paper' : 'Half Paper' }}</td>
                        <td class="text-center">{{ number_format($bill->rate, 2) }}</td>
                        <td class="text-center">{{ $bill->quantity }}</td>
                        <td class="text-left">
                            {{ number_format($bill->count * $bill->rate * $bill->quantity, 2) }}
                        </td> --}}
                        <td class="text-center">
                            <a class="btn btn-sm btn-outline-success" href="{{route('billDetail.index',['id'=>$bill['id']])}}">View Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                {{-- <tfoot>
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
                </tfoot> --}}
            </table>
        </div>
    </div>
    {{-- MAIN-SECTION-PARTS --}}
</div>
@endsection




