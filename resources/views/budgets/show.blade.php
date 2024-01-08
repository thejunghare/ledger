@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <h1 class="mt-4">My Budget's
                </div>
                <div>
                    <a href="/b/create" class="fs-2">
                        <i class="fas fa-plus text-primary"></i>
                    </a>
                </div>
            </div>

            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Features</li>
            </ol>

            <div class="row py-4">
                @if ($budgets->isEmpty())
                    <p>No budgets available.</p>
                @else
                    @foreach ($budgets as $budget)
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card mb-4">
                                <div class="card-body d-flex justify-content-between">
                                    <div>{{ $budget->date }}</div>
                                    <div>
                                        <span> ₹{{ $budget->amount }}</span>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-decoration-none " href="/b/{{ $budget->id }}">Details</a>
                                    <div class="small d-flex align-items-center">
                                        <form action="/b/{{ $budget->id }}/edit" method="get">
                                            @csrf
                                            <button type="submit" class="btn"><i
                                                    class="fas fa-pencil text-success"></i></button>
                                        </form>
                                        <form action="/b/{{ $budget->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn"><i
                                                    class="fas fa-trash text-danger"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </main>
@endsection
