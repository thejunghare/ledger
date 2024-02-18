@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">

              Today's Financial Overview</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between fw-semibold">
                            <div class="">
                                Budget:
                            </div>
                            <div class="">
                                ₹{{ $formattedTotalBudgetAmount ?? 'N/A' }}
                            </div>
                        </div>

                        {{-- <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white text-decoration-none" href="/b">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between fw-semibold">
                            <div class="">
                                Balance:
                            </div>
                            <div class="">
                                ₹{{ $formattedBalance ?? 'N/A' }}
                            </div>
                        </div>
                        {{-- <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white text-decoration-none" href="/d">View Details</a>
                            <div class="small text-white "><i class="fas fa-angle-right"></i></div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between fw-semibold">
                            <div class="">
                                Income:
                            </div>
                            <div class="">
                                ₹{{ $formattedIncomeAmount }}
                            </div>
                        </div>
                        {{-- <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white text-decoration-none" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between fw-semibold">
                            <div class="">
                                Spending:
                            </div>
                            <div class="">
                                ₹{{ $formattedExpenseAmount }}
                            </div>
                        </div>
                        {{-- <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white text-decoration-none" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Recent Transaction
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Paymode</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sr.No</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Paymode</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ($transactions->isEmpty())
                                <p>No transactions available.</p>
                            @else
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $serialNumber }}</td>
                                        <td>
                                           {{--  @if ($transactionDetails->category_type == 'Expense')
                                                <p class="text-danger mb-0">{{ $transactionDetails->category_type }}</p>
                                            @else
                                                <p class="text-success mb-0">{{ $transactionDetails->category_type }}</p>
                                            @endif --}}
                                            {{ $transactionDetails->category_type }}
                                        </td>
                                        <td>{{ $transaction->date }}</td>
                                        <td>
                                            @php
                                                $formattedAmount = number_format($transaction->amount, 2);
                                            @endphp
                                            ₹ {{ $formattedAmount }}
                                        </td>
                                        <td>{{ $transactionDetails->category_name }}</td>
                                        <td>{{ $transactionDetails->paymode_type }}</td>
                                    </tr>
                                    @php
                                        $serialNumber++;
                                    @endphp
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
