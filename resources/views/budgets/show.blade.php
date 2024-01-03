@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">My Budget's</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Features</li>
            </ol>

            <!-- form -->
            <form class="" method="post" action="/b">
                @csrf
                <div class="mb-3">
                    <label for="basic-url" class="form-label">Set Budget</label>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" name="date" placeholder="Date" aria-label="Username">
                        <span class="input-group-text">₹</span>
                        <input type="text" class="form-control" name="amount"
                            aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add budget</button>
            </form>

            <div class="row py-4">
                @if ($budgets->isEmpty())
                    <p>No budgets available.</p>
                @else
                    @foreach ($budgets as $budget)
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">{{ $budget->date }}</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small stretched-link" href="#">View Details</a>
                                    <div class="small"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </main>
@endsection
