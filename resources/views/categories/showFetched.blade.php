@if ($categories->isEmpty())
    <p>No Categories available.</p>
@else
    @foreach ($categories as $categories)
        <div class="col-xl-3 col-md-6 ">
            <div class="card mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div style="width: 60%">
                        {{ $categories->category_name }}
                    </div>
                    <div class="d-flex justify-content-between align-items-center" style="width: 40%">
                        <div>
                            <a href="{{ route('categories.edit', $categories->id) }}"
                                class="btn btn-light {{ $categories->isDefault ? 'disabled' : '' }}">Edit</a>
                        </div>
                        <div>
                            <form action="{{ route('categories.destroy', $categories->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-dark" {{ $categories->isDefault ? 'disabled' : '' }}>Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
