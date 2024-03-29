@extends('layouts.app')

@section('content')
    <main class="">
        @if (session('success'))
            <div class="position-relative mt-2">
                <div class="z-3 position-absolute top-0 start-50 translate-middle-x" id="alertsuccess">
                    <div class="alert alert-success fade show" role="alert" aria-live="polite">
                        <small> <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}</small>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class=" position-relative mt-2">
                <div class="z-3 position-absolute top-0 start-50 translate-middle-x" id="alerterror">
                    <div class="alert alert-danger fade show" role="alert">
                        <small> <i class="fa-solid fa-circle-exclamation me-2"></i>
                            {{ session('error') }} </small>
                    </div>
                </div>
            </div>
        @endif


        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <h1 class="mt-4">Group Budget
                </div>
                <div>
                    <a href="/g/b/create" class="fs-2">
                        <i class="fas fa-plus text-primary"></i>
                    </a>
                </div>
            </div>

            {{-- breadcrumb --}}
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Group budgets</li>
                </ol>
            </nav>

            <div class="row py-4">
                @if ($budgets->isEmpty())
                    <p>No group budgets available
                        <a href="/g/b/create" class="link-success">
                            create budget
                        </a>
                    </p>
                @else
                    @foreach ($budgets as $budget)
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card mb-4">
                                <div class="card-body d-flex justify-content-between">
                                    <div>{{ $budget->budget_name }}</div>
                                    <div>
                                        <span>
                                            @php
                                                $formattedBudgetAmount = number_format($budget->budget_amount, 2);
                                            @endphp
                                            ₹{{ $formattedBudgetAmount }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    {{-- see detailed budget --}}
                                    <a class="small text-decoration-none " href="/g/b/{{ $budget->id }}">Details</a>
                                    <div class="small d-flex align-items-center">
                                        {{-- edit --}}
                                        <form action="{{ route('groupBudget.edit', ['groupBudget' => $budget->id]) }}"
                                            method="get">
                                            @csrf
                                            <button type="submit" class="btn"><i
                                                    class="fas fa-pencil text-success"></i></button>
                                        </form>
                                        {{-- destroy --}}
                                        <form action="{{ route('groupBudget.destroy', ['groupBudget' => $budget->id]) }}"
                                            method="post">
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

                {{-- pagination --}}
                @if ($budgets->isNotEmpty())
                    {!! $budgets->links() !!}
                @endif
            </div>
        </div>


        <script>
            const successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.remove('show');
                }, 3000);
            }

            const errorAlert = document.querySelector('.alert-danger');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.classList.remove('show');
                }, 3000);
            }
        </script>
    </main>
@endsection
