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

                {{-- <example-component></example-component> --}}
                <div class="form-check form-switch  mb-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="switch" />
                    <label class="form-check-label" for="switch">Set category wise budget</label>
                </div>

                <div id="ischecked" class="d-none row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Select category</label>
                        <select id="inputState" class="form-select">
                            <option selected>Choose...</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Amount</label>
                        <input type="password" class="form-control" id="inputPassword4">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary rounded-2" id="addbudget">Add budget</button>
            </form>
        </div>
    </main>
@endsection
