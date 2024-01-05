@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <p class="mt-4 led">About</p>

        <div class="d-flex justify-content-center align-items-center flex-column">
            <h1 class="display-1"> {{ config('app.name') }}</h1>
            <p class="led">
                version: <abbr title="app version"><small>v 0.1.4 (basic)</small></abbr>
            </p>
        </div>

        <!-- boxes -->
        <div class="py-5">
            <ol class="list-group list-group-numbered list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Lead Developer</div>
                        Prasad Junghare
                    </div>

                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Help Center</div>
                        Answer to FAQ[s]
                    </div>

                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Social Network</div>
                        Follow Developer
                    </div>

                </li>
            </ol>
        </div>

        <p class="lead fs-6 text-center text-lowercase font-monospace fw-normal">made with ❤ by @thejunghare</p>

    </div>
</main>
@endsection
