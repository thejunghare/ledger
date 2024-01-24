@if ($categories->isEmpty())
<p>No Categories available.</p>
@else
@foreach ($categories as $categories)
    <div class="col-xl-3 col-md-6 ">
        <div class="card mb-4">
            <div class="card-body">
                {{ $categories->category_name }}
            </div>
        </div>
    </div>
@endforeach
@endif
