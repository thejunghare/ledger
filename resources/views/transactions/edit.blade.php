@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4 py-4">
            {{-- <nav aria-label="breadcrumb" class="mt-4 mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item small"><a href="/home" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item small"><a href="/home" class="text-decoration-none">Transaction</a></li>
                    <li class="breadcrumb-item active small" aria-current="page">Transaction Details</li>
                </ol>
            </nav> --}}

            <!-- form -->
            <form method="POST" action="/t/{{ $getTransaction->id }}">
                @csrf
                @method('PUT')
                {{-- type of transaction --}}
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="form-checK">
                        <input class="form-check-input" type="radio" name="type" id="expense"
                            value="{{ $getTransaction->type }}" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Expense
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="income"
                            value="{{ $getTransaction->type }}">
                        <label class="form-check-label" for="exampleRadios2">
                            Income
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="transfer"
                            value="{{ $getTransaction->type }}" disabled>
                        <label class="form-check-label" for="exampleRadios3">
                            Transfer
                        </label>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    {{-- date of transaction --}}
                    <div class="col">
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ $getTransaction->date }}" required>
                    </div>
                    {{-- amount of transaction --}}
                    <div class="col input-group">
                        <span class="input-group-text">₹</span>
                        {{-- <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"> --}}
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="50"
                            value="{{ $getTransaction->amount }}" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    {{-- category --}}
                    <div class="col">
                        <select class="form-select" aria-label="Default select example" name="category"
                            value="{{ $getTransaction->category }}" required>
                            <option selected>Category</option>
                            <option value="other">Other
                            </option>
                            <option value="food/drinks">Food/Drinks</option>
                            <option value="shopping">Shopping</option>
                            <option value="travelling">Travelling</option>
                            <option value="enterainment">Enterainment</option>
                            <option value="medical">Medical</option>
                            <option value="salary">Salary</option>
                            <option value="rent">Rent</option>
                            <option value="sold_items">Sold Items</option>
                        </select>
                    </div>
                    {{-- paymode --}}
                    <div class="col">
                        <select class="form-select" aria-label="Default select example" name="paymode"
                            value="{{ $getTransaction->paymode }}">
                            <option selected>Payment Mode</option>
                            <option value="cash">Cash
                            </option>
                            <option value="bank">Bank</option>
                            <option value="upi">UPI</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </main>
@endsection
