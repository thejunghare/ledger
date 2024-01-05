@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">My Budget's</h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Features</li>
        </ol>
        <!-- form -->
        <form class="py-4 " method="post" action="/b" id="addbudgetform">
            @csrf
            <div class="mb-3">
                <label for="basic-url" class="form-label">Set Budget</label>
                <div class="input-group mb-3">
                    <!-- date -->
                    <input type="date" class="form-control" required name="date" placeholder="Date"
                           aria-label="Username">
                    <span class="input-group-text">₹</span>
                    <!-- amount -->
                    <input id="amount" type="amount" class="form-control @error('amount') is-invalid @enderror"
                           name="amount" value="{{ old('amount') }}" autocomplete="amount" autofocus>
                    <span class="input-group-text">.00</span>
                    @error('amount')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <p class="text-danger fw-normal mark small d-inline" id="displayerror"></p>
            </div>
            <button type="submit" class="btn btn-primary" id="addbudget">Add budget</button>
        </form>
    </div>
</main>
@endsection
