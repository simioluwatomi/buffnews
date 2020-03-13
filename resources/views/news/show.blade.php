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

                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary ml-3 d-none d-sm-inline-block">

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

            @includeWhen(session('message'), 'partials.alert')

            <div class="card">

                @can('create', \App\Models\News::class)

                    <div class="dropdown card-dropdown">
                        <a href="#"
                           class="dropdown-ellipses float-right mr-3 mt-4" role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="icon icon-md">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="12" cy="5" r="1"></circle>
                                <circle cx="12" cy="19" r="1"></circle>
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">

                            <a href="{{ route('news.edit', ['news' => $newsItem]) }}" class="dropdown-item">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="icon">
                                    <path d="M12 20h9"></path>
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                </svg>

                                Edit
                            </a>

                            <a class="dropdown-item" href="{{ route('news.delete', ['news' => $newsItem]) }}"
                               onclick="event.preventDefault();
                               document.getElementById('delete-form').submit();"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="icon mr-2">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>

                                Delete

                                <form id="delete-form" action="{{ route('news.delete', ['news' => $newsItem]) }}"
                                      method="POST" class="d-none">

                                    @csrf

                                    @method('DELETE')


                                </form>

                            </a>

                        </div>

                    </div>

                @endcan

                <div class="card-body p-md-5">

                    {!! $newsItem->body !!}

                </div>

                <div class="card-footer">

                    <div class="row align-items-center">

                        <div class="col-auto">

                            {{ $newsItem->publisher->full_name }}

                        </div>

                        <div class="col-auto ml-auto">

                            {{ $newsItem->created_at->diffForHumans() }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
