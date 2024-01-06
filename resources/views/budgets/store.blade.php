@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add Budget <i class="bi bi-0-circle"></i></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Features</li>


        </ol>
        <!-- form -->
        <form class="py-4 " method="post" action="/b" id="addbudgetform">
            @csrf

            <div class="row g-3">
                <div class="col input-group mb-3">
                    <!-- date -->
                    <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-calendar-days"></i>
                    </span>
                    <input type="date" class="form-control" required name="date" placeholder="Date"
                           aria-label="Username" id="date">
                </div>
                <div class="col input-group mb-3">
                    <!-- amount -->
                    <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                    </span>
                    <input id="amount" type="amount" class="form-control @error('amount') is-invalid @enderror"
                           name="amount" value="{{ old('amount') }}" autocomplete="amount" autofocus>

                    @error('amount')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary" id="addbudget">Add budget</button>
        </form>
    </div>
</main>
@endsection
