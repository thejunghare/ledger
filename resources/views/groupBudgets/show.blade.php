@extends('layouts.app')

@section('content')
    <main>
        @if (session('success'))
            <div class="position-relative mt-2">
                <div class="z-3 position-absolute top-0 start-50 translate-middle-x" id="alertsuccess">
                    <div class="alert alert-success fade show" role="alert" aria-live="polite">
                        <small> <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}</small>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class=" position-relative mt-2">
                <div class="z-3 position-absolute top-0 start-50 translate-middle-x" id="alerterror">
                    <div class="alert alert-danger fade show" role="alert">
                        <small> <i class="fa-solid fa-circle-exclamation me-2"></i>
                            {{ session('error') }} </small>
                    </div>
                </div>
            </div>
        @endif

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

            {{-- table --}}
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Recent Transaction
                    | <a href="/group/budget/{{ $budgetId }}/transaction/create">Add transaction</a>
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
                                <th>Action</th>
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
                                <th>Action</th>
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
                                            ₹{{ $transaction->amount }}
                                        </td>
                                        <td>
                                            {{ $transaction->category_name }}
                                        </td>
                                        <td>
                                            {{ $transaction->paymode_type }}
                                        </td>
                                        <td class="d-flex align-items-center justify-content-center">
                                            <a href="/group/budget/transaction/{groupBudgetTransaction}/edit"
                                                class="fw-semibold text-primary text-decoration-underline">Edit</a>

                                            <form action="/group/budget/transaction/{{ $transaction->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="fw-semibold text-danger text-decoration-underline mx-2"
                                                    wire:click="delete">
                                                    Remove
                                                </button>
                                            </form>
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
        <script>
            const successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.remove('show');
                }, 3000);
            }

            const errorAlert = document.querySelector('.alert-danger');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.classList.remove('show');
                }, 3000);
            }
        </script>
    </main>
@endsection

{{--
    code things that will reflect your presonality

    --}}
