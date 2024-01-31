{{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
{{-- <div>

    {{ $transactions }}
</div> --}}

<div>
    @foreach ($transactions as $transaction)
        <x-group-budget-transactions :transaction="$transaction"/>
    @endforeach
</div>

