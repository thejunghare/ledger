@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add Transaction</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Features</li>
            </ol>

            <!-- form -->
            <form class="" method="post" action="/t">
                @csrf
                {{-- type of transaction --}}
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="form-checK">
                        <input class="form-check-input" type="radio" name="type" id="expense" value="Expense" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Expense
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="income" value="Income">
                        <label class="form-check-label" for="exampleRadios2">
                            Income
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="transfer" value="Transfer"
                            disabled>
                        <label class="form-check-label" for="exampleRadios3">
                            Transfer
                        </label>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    {{-- date of transaction --}}
                    <div class="col">
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    {{-- amount of transaction --}}
                    <div class="col input-group">
                        <span class="input-group-text">₹</span>
                        {{-- <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"> --}}
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="50" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    {{-- category --}}
                    <div class="col">
                        <select class="form-select" aria-label="Default select example" name="category">
                            <option selected>Category</option>
                            <option value="other">Other</option>
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
                        <select class="form-select" aria-label="Default select example" name="paymode">
                            <option selected>Payment Mode</option>
                            <option value="cash">Cash</option>
                            <option value="bank">Bank</option>
                            <option value="upi">UPI</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </main>
@endsection
