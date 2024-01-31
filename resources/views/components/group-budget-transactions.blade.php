{{-- table --}}
<div class="card mb-4" >
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Recent Transaction
        | <a href="/group/budget/transaction/create">Add transaction</a>
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
                    <th>Action</th>
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
                    <th>Action</th>
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
                            <td>
                                {{ $serialNumber }}
                            </td>
                            <td>
                                @if ($transaction->transaction_type_id == 2)
                                    <p class="text-danger mb-0">{{ $transaction->category_type }}</p>
                                @else
                                    <p class="text-success mb-0">{{ $transaction->category_type }}</p>
                                @endif
                            </td>
                            <td>
                                {{ $transaction->created_at }}
                            </td>
                            <td>
                                ₹{{ $transaction->amount }}
                            </td>
                            <td>
                                {{ $transaction->category_name }}
                            </td>
                            <td>
                                {{ $transaction->paymode_type }}
                            </td>
                            <td class="d-flex align-items-center justify-content-center">
                                <a href="/group/budget/transaction/{groupBudgetTransaction}/edit"
                                    class="fw-semibold text-primary text-decoration-underline">Edit</a>

                                <form action="/group/budget/transaction/{{ $transaction->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="fw-semibold text-danger text-decoration-underline mx-2"
                                        wire:click="delete">
                                        Remove
                                    </button>
                                </form>

                            </td>
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
