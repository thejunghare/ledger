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
                    </div>
                </div>
            </div>

            <a href="/g/b/{{ $budgetId }}/t/create" class="btn btn-primary mb-3 *:" data-bs-toggle="tooltip"
                data-bs-title="Add transaction">
                <span>
                    <i class="fa fa-plus-circle  me-2" aria-hidden="true"></i>
                </span>
                Add transactions
            </a>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Transaction</th>
                            <th scope="col">Date</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Category</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @php
                            $serialNumber = 1;
                        @endphp
                        @forelse ($transactions as $transaction)
                            <tr>
                                <th scope="row"> {{ $serialNumber++ }}</th>
                                <td>
                                    @if ($transaction->transaction_type_id == 2)
                                        <p class="text-danger mb-0">{{ $transaction->category_type }}</p>
                                    @else
                                        <p class="text-success mb-0">{{ $transaction->category_type }}</p>
                                    @endif
                                </td>
                                <td>{{ $transaction->created_at }}</td>
                                <td> ₹{{ $transaction->amount }}</td>
                                <td> {{ $transaction->category_name }}</td>
                                <td>{{ $transaction->paymode_type }}</td>
                                <td class="d-flex align-items-center justify-content-start">
                                    <a href="/g/b/t/{groupBudgetTransaction}/edit"
                                        class="fw-semibold text-primary text-decoration-underline">
                                        <span>
                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        </span>
                                    </a>

                                    <form action="/g/b/t/{{ $transaction->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn fw-semibold bg-white btn-outline-light border-none text-danger text-decoration-underline mx-2"
                                            wire:click="delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @empty
                            <p>No transactions available.</p>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- pagination --}}
            <div>
                {!! $transactions->links() !!}
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
