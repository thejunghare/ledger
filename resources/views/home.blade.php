@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="">
                                Transactions:
                            </div>
                            <div class="">
                                {{ $transactioncount ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white text-decoration-none" href="/t">View Details</a>
                            <div class="small text-white "><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="">
                                Budgets:
                            </div>
                            <div class="">
                                {{ $budgetcount ?? 'N/A' }}
                            </div>
                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white text-decoration-none" href="/b">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="">
                                Income:
                            </div>
                            <div class="">
                                ₹{{ $formattedIncomeAmount }}
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white text-decoration-none" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="">
                                Spending:
                            </div>
                            <div class="">
                                ₹ {{ $formattedExpenseAmount }}
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white text-decoration-none" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
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
                                            @if ($transaction->type === 'Expense')
                                                <p class="text-danger mb-0">{{ $transaction->type }}</p>
                                            @else
                                                <p class="text-success mb-0">{{ $transaction->type }}</p>
                                            @endif
                                        </td>
                                        <td>{{ $transaction->date }}</td>
                                        <td>
                                            @php
                                                $formattedAmount = number_format($transaction->amount);
                                            @endphp
                                            ₹ {{ $formattedAmount }}
                                        </td>
                                        <td>{{ $transaction->category }}</td>
                                        <td>{{ $transaction->paymode }}</td>
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
