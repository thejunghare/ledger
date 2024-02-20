@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add transaction <i class="bi bi-0-circle"></i></h1>

            {{-- breadcrumb --}}
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/g/b/{{ $budgetId }}">Group Budget</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add transaction</li>
                </ol>
            </nav>

            <!-- form -->
            <form class="" method="POST" action="{{ route('groupBudgetTransaction.store') }}">
                @csrf
                {{-- @dd($errors->all()); --}}

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

                {{-- budget id to add the transaction --}}
                <div class="col">
                    {{-- i want the id here --}}
                    <input value="{{ $budgetId }}" hidden type="text" placeholder="Selected budget"
                        class="form-control" id="date" name="for_budget_id" required>
                </div>

                <div class="row g-3 mb-3">
                    {{-- date of transaction --}}
                    <div class="col">
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                            name="date" value="{{ old('date') }}" autocomplete="date" autofocus>
                        @error('date')
                            <span role="alert" class="invalid-feedback">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    {{-- amount of transaction --}}
                    <div class="col input-group">
                        <span class="input-group-text">₹</span>
                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                            name="amount" placeholder="50" value="{{ old('amount') }}" autofocus autocomplete="amount">
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
