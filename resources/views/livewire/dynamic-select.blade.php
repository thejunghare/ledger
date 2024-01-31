<div>
    {{-- The best athlete wants his opponent at his best. --}}

    {{-- type of transaction --}}
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="form-check">
            <input wire:model="selectedTransactionType" wire:click="updateTransactionType(2)" class="form-check-input" type="radio" name="type" id="expense" value="2" checked>
            <label class="form-check-label" for="expense">
                Expense
            </label>
        </div>
        <div class="form-check">
            <input wire:model="selectedTransactionType" wire:click="updateTransactionType(1)" class="form-check-input" type="radio" name="type" id="income" value="1">
            <label class="form-check-label" for="income">
                Income
            </label>
        </div>
        <div class="form-check">
            <input wire:model="selectedTransactionType" wire:click="updateTransactionType('Transfer')" class="form-check-input" type="radio" name="type" id="transfer" value="Transfer" disabled>
            <label class="form-check-label" for="transfer">
                Transfer
            </label>
        </div>
    </div>

    <div class="row g-3 mb-3">
        {{-- category --}}
        <div class="col">
            <select wire:model="selectedCategory" class="form-select" aria-label="Default select example" name="category" id="categoryOptions">
                <option disabled selected value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value={{ $category->id }}> {{$category->category_name}} </option>
                @endforeach
            </select>
        </div>
        {{-- paymode --}}
        <div class="col">
            <select wire:model="selectedPaymode" class="form-select" aria-label="Default select example" name="paymode">
                <option value="" disabled selected>Select payment mode</option>
                @foreach ($paymodes as $paymode)
                    <option value="{{$paymode->id}}" >{{ $paymode->paymode_type }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
