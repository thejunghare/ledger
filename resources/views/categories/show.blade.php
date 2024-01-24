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

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filter" id="inlineRadio1" value="2" checked />
                <label class="form-check-label" for="inlineRadio1">Expense</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filter" id="inlineRadio2" value="1" />
                <label class="form-check-label" for="inlineRadio2">Income</label>
            </div>

            <div id="recordsContainer" class="row py-4">

            </div>
        </div>

        <script>
            /* const successAlert = document.querySelector('.alert-success');
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
                                                                                                                                                            } */



            $(document).ready(function() {

                // Define the handleRadioChange function
                function handleRadioChange(filterValue) {
                    $.ajax({
                        url: '{{ route('DefaultCategories.index') }}',
                        type: 'GET',
                        data: {
                            filter: filterValue
                        },
                        success: function(response) {
                            if (response) {
                                $('#recordsContainer').html(response.html);
                            } else {
                                $('#recordsContainer').html('<p>No data available.</p>');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $("#recordsContainer").html("An error occurred. Please try again later.");
                            console.error("AJAX error:", errorThrown);
                        }
                    });
                }

                // Trigger initial AJAX request
                handleRadioChange(2); // Call with default filter value

                // Set default checked radio button
                $('input[name=filter][value=2]').prop('checked', true);

                // Handle radio button changes
                $('input[name=filter]').change(function() {
                    const filterValue = $(this).val();
                    handleRadioChange(filterValue);
                });
            });
        </script>
    </main>
@endsection
