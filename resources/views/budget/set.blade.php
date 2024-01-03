@extends('layouts.app')

@section('content')
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Set Budget</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Features</li>
                    </ol>

                    <div class="card">
                        <div class="card-header">
                            No Budgets Set
                        </div>
                        <!--  title -->
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">Setting up a budget lets you plan your expenditure, and it ensures that you
                                meet your goal of saving the desired amount of money at the end of the month</p>
                            <a href="#" class="btn btn-primary">Set Budget</a>
                        </div>
                    </div>

                    <!-- form -->
                    <form class="py-4">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </main>
@endsection
