@extends('layouts.master')

@section('content')

    @includeWhen(session('message'), 'partials.alert')

    <!-- Page title -->
    <div class="page-title-box">

        <div class="row align-items-center">

            <div class="col-auto">

                <h2 class="page-title">
                    Home
                </h2>

            </div>

        </div>

    </div>

    <div class="row row-deck">

        @foreach($news as $item)

            <div class="col-sm-6 col-xl-4">

                <div class="card d-flex flex-column">

                    <div class="card-body d-flex flex-column">

                        <h3 class="card-title">

                            <a href="{{ route('news.show', ['news' => $item]) }}">{{ $item->title }}</a>

                        </h3>

                        <div class="text-muted">{{ Str::limit($item->body, 80) }}</div>

                        <div class="d-flex align-items-center pt-5 mt-auto">

                            <span class="avatar avatar-md">{{ $item->publisher->initials }}</span>

                            <div class="ml-3">

                                <p class="text-body mb-0">{{ $item->publisher->full_name }}</p>

                                <small class="d-block text-muted">{{ $item->created_at->diffForHumans() }}</small>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer">

                       {{ $item->category->title }}

                    </div>

                </div>

            </div>

        @endforeach

    </div>

    <div class="float-right">

        {{ $news->links() }}

    </div>

@endsection
