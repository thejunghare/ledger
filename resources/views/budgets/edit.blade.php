@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4 py-4">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/b">Budgets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit budget</li>
                </ol>
            </nav>

            <!-- form -->
            <form method="POST" action="/b/{{ $getBudget->id }}">
                @csrf
                @method('PUT')


                <div class="row g-3 mb-3">
                    {{-- date of transaction --}}
                    <div class="col">
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ $getBudget->date }}" required>
                    </div>
                    {{-- amount of transaction --}}
                    <div class="col input-group">
                        <span class="input-group-text">₹</span>
                        {{-- <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"> --}}
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="50"
                            value="{{ $getBudget->amount }}" required>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </main>
@endsection
