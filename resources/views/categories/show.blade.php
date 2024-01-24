@extends('layouts.app')

@section('content')
    <main class="">
        {{--  @if (session('success'))
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
        @endif --}}

        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <h1 class="mt-4">My Categories
                </div>
                <div>
                    <a href="/b/create" class="fs-2">
                        <i class="fas fa-plus text-primary"></i>
                    </a>
                </div>
            </div>

            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Features</li>
            </ol>

            <div class="row py-4">
                @if ($categories->isEmpty())
                    <p>No Categories available.</p>
                @else
                    @foreach ($incomeCategories as $categories)
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card mb-4">
                                <div class="card-body">
                                    {{ $categories->category_name }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- <script>
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
        </script> --}}
    </main>
@endsection
