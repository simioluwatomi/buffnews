@extends('layouts.master')

@push('styles')

    <style>
        #quill-container {
            height: 400px;
        }
    </style>

@endpush

@section('content')

    <div class="row">

        <div class="col-md-8 mx-auto">

            <h3 class="mt-5 text-muted text-uppercase text-center">
                Publish
            </h3>

            <hr>

            <form action="{{ route('news.store') }}" method="post" autocomplete="off" id="news-form">

                @csrf

                <div class="form-group mb-4">

                    <label for="category">
                        Category
                        <span class="form-required">*</span>
                    </label>

                    <select id="category"
                            name="category_id"
                            class="form-control custom-select @error('category_id') is-invalid @enderror"
                            required
                    >
                        <option value="" selected disabled hidden>Select a category</option>

                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->title }}
                            </option>
                        @endforeach

                    </select>

                    @error('category_id')
                    @include('partials.invalid-feedback')
                    @enderror

                </div>

                <div class="form-group mb-4">

                    <label for="title">
                        Title
                        <span class="form-required">*</span>
                    </label>

                    <input id="title"
                           name="title"
                           type="text"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}"
                           placeholder="Enter the news title here"
                           required
                    >

                    @error('title')
                    @include('partials.invalid-feedback')
                    @enderror

                </div>

                <textarea type="text" name="body" class="d-none" id="text-area-quill"></textarea>


                <div id="quill-container" class="@error('body') is-invalid border border-danger @enderror">
                </div>

                @error('body')
                @include('partials.invalid-feedback')
                @enderror

                <button type="submit" class="btn btn-primary mt-3">Submit</button>

            </form>

        </div>

    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {
            let quill = new Quill('#quill-container', {
                placeholder: 'Enter the news body',
                theme: 'snow'
            });

            let form = document.getElementById('news-form');

            form.onsubmit = function () {
                if (quill.getLength() > 10) {
                    $('#text-area-quill').text($('.ql-editor').html());
                }
            };

        });
    </script>

@endpush
