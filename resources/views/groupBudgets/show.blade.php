@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            {{-- header to display group name --}}
            <h1 class="mt-4">{{ $groupBudgetName->budget_name }}</h1>

            {{-- breadcrumb --}}
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            {{-- card layout --}}
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="">
                                Total budget amount:
                            </div>
                            <div class="">
                                ₹ {{ $formattedGroupBudgetAmount ?? 'N/A' }}
                            </div>
                        </div>
                        {{-- <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white text-decoration-none" href="/d">View Details</a>
                            <div class="small text-white "><i class="fas fa-angle-right"></i></div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="">
                                Balance:
                            </div>
                            <div class="">
                                {{ $formattedTotalBalanceAmount ?? 'N/A' }}
                            </div>
                        </div>

                        {{-- <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white text-decoration-none" href="/b">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="">
                                Income:
                            </div>
                            <div class="">
                                ₹ {{ $formattedTotalIncomeTransactionAmount }}
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
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="">
                                Total Spending:
                            </div>
                            <div class="">
                                ₹ {{ $formattedTotalExpenseTransactionAmount }}
                            </div>
                        </div>
                        {{-- <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white text-decoration-none" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div> --}}
                    </div>
                </div>
            </div>

            {{-- table --}}
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
                                        <td>
                                            {{ $serialNumber }}
                                        </td>
                                        <td>
                                            @if ($transaction->transaction_type_id == 2)
                                                <p class="text-danger mb-0">{{ $transaction->category_type }}</p>
                                            @else
                                                <p class="text-success mb-0">{{ $transaction->category_type }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $transaction->created_at }}
                                        </td>
                                        <td>
                                            ₹ {{ $formattedGroupBudgetAmount }}
                                        </td>
                                        <td>
                                            {{ $transaction->category_name}}
                                        </td>
                                        <td>
                                            {{ $transaction->paymode_type }}
                                        </td>
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
