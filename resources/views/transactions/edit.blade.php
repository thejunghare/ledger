@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4 py-4">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/t">Transaction</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update transaction</li>
                </ol>
            </nav>

            <!-- form -->
            <form method="POST" action="/t/{{ $getTransactionDetails->id }}">
                @csrf
                @method('PUT')

                {{-- income or expense --}}
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="form-checK">
                        <input class="form-check-input" type="radio" name="transaction_type_id" id="expense"
                            value="{{ old('transaction_type_id') ?? $getTransactionDetails->transaction_type_id }}" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Expense
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="transaction_type_id" id="income"
                            value="{{ old('transaction_type_id') ?? $getTransactionDetails->transaction_type_id }}">
                        <label class="form-check-label" for="exampleRadios2">
                            Income
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="transaction_type_id" id="transfer"
                            value="{{ old('transaction_type_id') ?? $getTransactionDetails->transaction_type_id }}"
                            disabled>
                        <label class="form-check-label" for="exampleRadios3">
                            Transfer
                        </label>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    {{-- date --}}
                    <div class="col">
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                            name="date" value="{{ old('date') ?? $getTransactionDetails->date }}" autofocus required
                            autocomplete="date">
                        @error('date')
                            <span role="alert" class="invalid-feedback">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                    {{-- amount --}}
                    <div class="col input-group">
                        <span class="input-group-text">₹</span>
                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                            name="amount" placeholder="50" value="{{ old('amount') ?? $getTransactionDetails->amount }}"
                            autofocus required autocomplete="amount">
                        @error('amount')
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
                            aria-label="Default select example" name="category_id" autofocus required
                            value="{{ old('category_id') ?? $getTransactionDetails->category_id }}"
                            autocomplete="category-options">
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
                            aria-label="Default select example" name="paymode_id" autofocus required
                            value="{{ old('paymode_id') ?? $getTransactionDetails->paymode_id }}"
                            autocomplete="paymode-options">
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

                <button type="submit" class="btn btn-primary">Update</button>
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
