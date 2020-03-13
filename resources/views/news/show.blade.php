@extends('layouts.master')

@section('content')

    <div class="page-title-box">

        <div class="row align-items-center">

            <div class="col-auto">

                <div class="page-pretitle mb-2">

                    {{ $newsItem->category->title }}

                </div>

                <h2 class="page-title">

                    {{ $newsItem->title }}

                </h2>

            </div>

            <div class="col-auto ml-auto d-print-none">

                <a href="{{ url()->previous() }}" class="btn btn-outline-danger ml-3 d-none d-sm-inline-block">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>

                    Back
                </a>

            </div>

        </div>

    </div>

    <div class="row justify-content-center">

        <div class="col-lg-10 col-xl-8">

            <div class="card">

                <div class="card-body p-md-6">

                    {{ $newsItem->body }}

                </div>

                <div class="card-footer text-center">

                    {{ $newsItem->publisher->full_name }}

                </div>

            </div>

        </div>

    </div>

@endsection
