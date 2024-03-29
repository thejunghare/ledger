@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit category <i class="bi bi-0-circle"></i></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Features</li>
            </ol>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/categories">categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">edit categories</li>
                </ol>
            </nav>

            <!-- form -->
            <form class="" action="{{ route('categories.update', $category->id) }}" method="post"
                id="editCategoryForm">
                @csrf
                @method('PUT')
                <div class="col input-group mb-3">
                    <input id="isDefault" type="number" class="form-control" name="isDefault" value="0" hidden>
                </div>
                <div class="row g-3">

                    <div class="col input-group mb-3">
                        <!-- category type -->
                        <select id="category-type-options"
                            class="form-control @error('category-type-options') is-invalid @enderror"
                            aria-label="Default select example" name="category_type_id"
                            value="{{ $category->category_type_id }}" required autofocus
                            autocomplete="category-type-options">
                            <option value="" disabled selected>Select category</option>
                        </select>
                        @error('category_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col input-group mb-3">
                        <!-- category name -->
                        <input id="category_name" type="text"
                            class="form-control @error('category_name') is-invalid @enderror" name="category_name"
                            placeholder="Enter category name" value="{{ $category->category_name }}"
                            autocomplete="category_name" autofocus>

                        @error('category_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary rounded-2" id="addCategoryType">Update</button>
            </form>
        </div>
        <script>
            $(document).ready(function() {

                var categoryTypeSelectOption = $('#category-type-options');

                $.ajax({
                    url: '/categories-type-options',
                    method: 'GET',
                    success: function(data) {
                        categoryTypeSelectOption.empty();
                        categoryTypeSelectOption.append(
                            '<option value="" disabled selected>Select category type</option>');

                        $.each(data, function(index, option) {
                            categoryTypeSelectOption.append('<option value="' + option.id + '">' +
                                option
                                .category_type + '</option>');
                        });

                        categoryTypeSelectOption.val('{{ $category->category_type_id }}')

                    },
                    error: function(error) {
                        console.error('Error fetching category type options:', error);
                    }
                });



            });
        </script>
    </main>
@endsection
