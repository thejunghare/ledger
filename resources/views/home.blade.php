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
                    <div class="card-body">Transactions

                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Budgets
                        <span> {{ $count }} </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Income</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Spending</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
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
                    {{-- @if ($transactions->isEmpty())
                    <p>No transactions available.</p>
                    @else
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>1</td>
                        <td>{{ $transaction->date }}</td>
                    </tr>
                    @endforeach
                    @endif --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
