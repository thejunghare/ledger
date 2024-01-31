@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            {{-- header to display group name --}}
            <h1 class="mt-4">{{ $groupBudgetName->budget_name }}</h1>

            {{-- breadcrumb --}}
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/group/budgets"> Group budgets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Budget details</li>
                </ol>
            </nav>

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

            {{-- {{ $transactions }} --}}

            <x-group-budget-transactions />
        </div>
    </main>
@endsection

{{--
    code things that will reflect your presonality

    --}}
