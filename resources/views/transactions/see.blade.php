@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4 py-4">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/t">Transactions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transcations details</li>
                </ol>
            </nav>


            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">

                    <div class="card">
                        <div class="card-header">Details</div>
                        <div
                            class="card-body {{ $transactionDetails->category_type == 'Income' ? 'text-success' : 'text-danger' }}">
                            <h5 class="card-title text-center">
                                @php
                                    $formattedAmount = number_format($transaction->amount, 2);
                                @endphp
                                ₹{{ $formattedAmount }}
                            </h5>
                            <p class="text-center samll">{{ $transaction->date }}</p>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item">
                                    <span class="font-monospace">
                                        Transaction type: {{ $transactionDetails->category_type }}
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <span class="font-monospace">
                                        Category: {{ $transactionDetails->category_name }}
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <span class="font-monospacee">
                                        Payment mode: {{ $transactionDetails->paymode_type }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="#" class="btn btn-primary">Share</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>
@endsection
