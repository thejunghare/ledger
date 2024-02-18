@extends('layouts.app')

@section('content')
    <main>
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
                    <h1 class="mt-4">Your daily transactions
                </div>
                <div>
                    <a href="/t/create" class="fs-2">
                        <i class="fas fa-plus text-primary"></i>
                    </a>
                </div>
            </div>

            {{--   <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Features</li>
            </ol> --}}

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                </ol>
            </nav>

            <div class="row py-4">
                @if ($transactions->isEmpty())
                    <p>No transactions available.</p>
                @else
                    @foreach ($transactions as $transaction)
                        <div class="col-xl-3 col-md-6 ">
                            <div
                                class="card {{ $transaction->category_type == 'Income' ? 'text-bg-success' : 'text-bg-danger' }} mb-4">
                                <div class="card-body d-flex justify-content-between">
                                    <div>{{ $transaction->date }}</div>
                                    <div>
                                        <span>
                                            @php
                                                $formattedAmount = number_format($transaction->amount, 2);
                                            @endphp
                                            ₹ {{ $formattedAmount }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-decoration-underline text-white"
                                        href="/t/{{ $transaction->id }}">Details</a>
                                    <div class="small d-flex align-items-center">
                                        <form action="/t/{{ $transaction->id }}/edit" method="get">
                                            @csrf
                                            <button type="submit" class="btn"><i
                                                    class="fas fa-pencil text-white"></i></button>
                                        </form>
                                        <form action="/t/{{ $transaction->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn"><i
                                                    class="fas fa-trash text-white"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
