@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4 py-4">
            {{-- <nav aria-label="breadcrumb" class="mt-4 mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item small"><a href="/home" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item small"><a href="/home" class="text-decoration-none">Transaction</a></li>
                    <li class="breadcrumb-item active small" aria-current="page">Transaction Details</li>
                </ol>
            </nav> --}}


            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">₹{{ $getBudget->amount }}</h5>
                            <p class="text-center samll">{{ $getBudget->date }}</p>
                            <ul class="list-group list-group-flush mb-3">
                                <li  class="list-group-item">Type: {{ $getBudget->created_at }}</li>
                            </ul>
                            <a href="#" class="btn btn-primary">Share</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
