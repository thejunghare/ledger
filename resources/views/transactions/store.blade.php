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
                    {{-- Expense --}}
                    <div class="form-check">
                        <input class="form-check-input @error('transaction_type_id') is-invalid @enderror" type="radio"
                            name="transaction_type_id" id="expense" value="2" checked
                            autocomplete="transaction_type_id" autofocus>
                        <label class="form-check-label" for="expense">
                            Expense
                        </label>
                        @error('transaction_type_id')
                            <span role="alert" class="invalid-feedback">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Income --}}
                    <div class="form-check">
                        <input class="form-check-input @error('transaction_type_id') is-invalid @enderror" type="radio"
                            name="transaction_type_id" id="income" value="1" autocomplete="transaction_type_id"
                            autofocus>
                        <label class="form-check-label" for="income">
                            Income
                        </label>
                        @error('transaction_type_id')
                            <span role="alert" class="invalid-feedback">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Transfer --}}
                    <div class="form-check">
                        <input class="form-check-input @error('transaction_type_id') is-invalid @enderror " type="radio"
                            name="transaction_type_id" id="transfer" value="3" disabled
                            autocomplete="transaction_type_id" autofocus>
                        <label class="form-check-label" for="transfer">
                            Transfer
                        </label>
                        @error('transaction_type_id')
                            <span role="alert" class="invalid-feedback">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    {{-- category --}}
                    <div class="col">
                        <select id="category-options" class="form-control @error('category-options') is-invalid @enderror"
                            aria-label="Default select example" name="category_id" required autofocus
                            value="{{ old('category_id') }}" autocomplete="category-options">
                            <option value="" disabled selected>Select category</option>
                        </select>
                        @error('category-options')
                            <span role="alert" class="invalid-feedback">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                    {{-- paymode --}}
                    <div class="col">
                        <select id="paymode-options" class="form-control @error('paymode-options') is-invalid @enderror"
                            aria-label="Default select example" name="paymode_id" required autofocus
                            value="{{ old('paymode_id') }}" autocomplete="paymode-options">
                            <option value="" disabled selected>Select payment mode</option>
                        </select>
                        @error('paymode-options')
                            <span role="alert" class="invalid-feedback">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
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



                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>


        <script>
            $(document).ready(function() {
                var paymodeSelectOption = $('#paymode-options');
                var categorySelectOption = $('#category-options');

                $.ajax({
                    url: '/paymode-options',
                    method: 'GET',
                    success: function(data) {
                        paymodeSelectOption.empty();
                        paymodeSelectOption.append(
                            '<option value="" disabled selected>Select payment mode</option>');

                        $.each(data, function(index, option) {
                            paymodeSelectOption.append('<option value="' + option.id + '">' + option
                                .paymode_type + '</option>');
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching payment options:', error);
                    }
                });

                $.ajax({
                    url: '/categories-options',
                    method: 'GET',
                    success: function(data) {
                        categorySelectOption.empty();
                        categorySelectOption.append(
                            '<option value="" disabled selected>Select category mode</option>');

                        $.each(data, function(index, option) {
                            categorySelectOption.append('<option value="' + option.id + '">' +
                                option
                                .category_name + '</option>');
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching payment options:', error);
                    }
                });
            });
        </script>
    </main>
@endsection
