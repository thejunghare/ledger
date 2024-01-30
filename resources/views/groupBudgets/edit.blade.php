@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update budget details <i class="bi bi-0-circle"></i></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Features</li>
            </ol>

            <!-- form -->
            <form class="py-4 " method="POST" action="{{route('groupBudget.update',  $budgetDetails->id)}}" id="updateGroupBudgetForm">
                @csrf
                @method('PATCH')

                <div class="row g-3">
                    <!-- Budget Name -->
                    <div class="col input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa-solid fa-calendar-days"></i>
                        </span>
                        <input type="text" class="form-control" name="budget_name" placeholder="Budget name"
                            aria-label="Budget name" id="budget_name" autocomplete="budget_name" autofocus value="{{ old('budget_name') ?? $budgetDetails->budget_name }}">
                    </div>
                    <!-- Budget Amount -->
                    <div class="col input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                        </span>
                        <input id="budget_amount" type="amount" class="form-control @error('budget_amount') is-invalid @enderror"
                            name="budget_amount"  autocomplete="budget_amount" autofocus value="{{ old('budget_amount') ?? $budgetDetails->budget_amount }}">

                        @error('budget_amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary rounded-2" id="addbudget">Update budget</button>
            </form>
        </div>
    </main>
@endsection

