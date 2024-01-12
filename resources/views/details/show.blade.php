@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4 led">Details</p>

            <div class="d-flex justify-content-between align-items-center">
                <div>Budget:
                    {{ $formattedBudget }}</div>
                <div>Date:
                    {{ $date }}
                </div>
            </div>

            <div class="card mb-4 mt-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Transaction
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Paymode</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sr.No</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Paymode</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ($transactions->isEmpty())
                                <p>No transactions available.</p>
                            @else
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $serialNumber }}</td>
                                        <td>
                                            @if ($transaction->type === 'Expense')
                                                <p class="text-danger mb-0">{{ $transaction->type }}</p>
                                            @else
                                                <p class="text-success mb-0">{{ $transaction->type }}</p>
                                            @endif
                                        </td>
                                        <td>{{ $transaction->date }}</td>
                                        <td>
                                            @php
                                                $formattedAmount = number_format($transaction->amount);
                                            @endphp
                                            ₹ {{ $formattedAmount }}
                                        </td>
                                        <td>{{ $transaction->category }}</td>
                                        <td>{{ $transaction->paymode }}</td>
                                    </tr>
                                    @php
                                        $serialNumber++;
                                    @endphp
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                Balance:

                {{ $getbalance }}
            </div>

        </div>
    </main>
@endsection
