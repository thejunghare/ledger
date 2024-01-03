@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <h1 class="mt-4">My Transactions's
                </div>
                <div>
                    <a href="/t/create" class="fs-2">
                        <i class="fas fa-plus text-primary"></i>
                    </a>
                </div>
            </div>

            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Features</li>
            </ol>

            <div class="row py-4">
                @if ($transactions->isEmpty())
                    <p>No transactions available.</p>
                @else
                    @foreach ($budgets as $budget)
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body d-flex justify-content-between">
                                    <div>{{ $budget->date }}</div>
                                    <div> <span>₹</span> {{ $budget->amount }}</div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small stretched-link " href="#">Budget Analysis</a>
                                    <div class="small">
                                        <i class="fas fa-pencil text-success me-3"></i>
                                        <i class="fas fa-trash text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </main>
@endsection
