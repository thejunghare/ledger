@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add transaction <i class="bi bi-0-circle"></i></h1>

            {{-- breadcrumb --}}
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/home">Group Budget</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add transaction</li>
                </ol>
            </nav>



            {{--

   things I will need
   for for_budget_id
transaction_type_id
amount
category_id
    paymode_id

    --}}
            <!-- form -->
            <form class="" method="post" action="/t">
                @csrf
                {{-- type of transaction --}}
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="form-checK">
                        <input class="form-check-input" type="radio" name="type" id="expense" value="Expense"
                            checked>
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
                        <select class="form-select" aria-label="Default select example" name="category"
                            id="categoryOptions">
                            <option selected>Choose Category</option>
                        </select>
                    </div>
                    {{-- paymode --}}
                    <div class="col">
                        <select class="form-select" aria-label="Default select example" name="paymode">
                            <option selected>Choose payment mode</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>

                <script>
                    $(document).ready(function() {
                        // Fetch options for category
                        $.ajax({
                            url: '/get-options',
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                // Populate the select element with options
                                $.each(data, function(key, value) {
                                    $('#categoryOptions').append('<option value="' + value.id + '">' + value
                                        .category_name + '</option>');
                                });
                            }
                        });

                        // Fetch options for payment mode
                        $.ajax({
                            url: '/get-paymode-options',
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $.each(data, fuction(key, value) {
                                    $('#paymentModeOptions').append('<option value="' + value.id + '">' +
                                        value.paymode_type '</option>')
                                });
                            }
                        })
                    });
                </script>
            </form>
        </div>
    </main>
@endsection
