@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add transaction <i class="bi bi-0-circle"></i></h1>

            {{-- breadcrumb --}}
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/group/budget/{{ $budgetId }}">Group Budget</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add transaction</li>
                </ol>
            </nav>

            <!-- form -->
            <form class="" method="POST" action="{{ route('groupBudgetTransaction.store') }}">
                @csrf
                {{-- @dd($errors->all()); --}}
                {{-- @livewire('dynamic-select') --}}

                {{-- type of transaction --}}
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="form-check">
                        <input wire:model="selectedTransactionType" wire:click="updateTransactionType(2)"
                            class="form-check-input" type="radio" name="type" id="expense" value="2" checked>
                        <label class="form-check-label" for="expense">
                            Expense
                        </label>
                    </div>
                    <div class="form-check">
                        <input wire:model="selectedTransactionType" wire:click="updateTransactionType(1)"
                            class="form-check-input" type="radio" name="type" id="income" value="1">
                        <label class="form-check-label" for="income">
                            Income
                        </label>
                    </div>
                    <div class="form-check">
                        <input wire:model="selectedTransactionType" wire:click="updateTransactionType('Transfer')"
                            class="form-check-input " type="radio" name="type" id="transfer" value="3" disabled>
                        <label class="form-check-label" for="transfer">
                            Transfer
                        </label>
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
                            name="created_at" value="{{ old('date') }}" autocomplete="date" autofocus>
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
                        {{-- <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"> --}}
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
                        <select wire:model="selectedCategory" class="form-select" aria-label="Default select example"
                            name="category" id="categoryOptions" required>
                            <option disabled selected value="">Select Category</option>
                            {{-- @foreach ($categories as $category)
                                <option value={{ $category->id }}> {{ $category->category_name }} </option>
                            @endforeach --}}
                        </select>
                    </div>
                    {{-- paymode --}}
                    <div class="col">
                        <select id="paymode-options" class="form-select" aria-label="Default select example" name="paymode"
                            required>
                            <option value="" disabled selected>Select payment mode</option>
                        </select>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

        <script>
            $(document).ready(function() {
                var selectElement = $('#paymode-options');

                $.ajax({
                    url: '/paymode-options',
                    method: 'GET',
                    success: function(data) {
                        selectElement.empty();
                        selectElement.append(
                            '<option value="" disabled selected>Select payment mode</option>');

                        $.each(data, function(index, option) {
                            selectElement.append('<option value="' + option.id + '">' + option
                                .paymode_type + '</option>');
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
