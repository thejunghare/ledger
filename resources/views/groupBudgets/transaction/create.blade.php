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

            <!-- form -->
            <form class="" method="post" action="/t">
                @csrf

                @livewire('dynamic-select')

                <div class="row g-3 mb-3">
                <div class="col">
                        <input value="" type="text" placeholder="Select budget" class="form-control" id="date" name="date" required>
                    </div>
                    {{-- date of transaction --}}
                    @php
                    $currentDate = date('mm/dd/y')
                    @endphp
                    <div class="col">
                        <input value="{{$currentDate}}" type="date" class="form-control" id="date" name="date" required>
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
    </main>
@endsection
