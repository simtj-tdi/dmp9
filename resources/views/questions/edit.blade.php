@extends('dashboard')

@section('content')

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Post Create</div>

            <div class="card-body">

                <form method="POST" action="{{ route('questions.update', $questions->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control  @error('title') is-invalid @enderror" name="title" value="{{ $questions->title }}" autocomplete="name">

                            @error('title')
                            <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label text-md-right">Content</label>

                        <div class="col-md-6">
                            <input id="content" type="text" class="form-control  @error('content') is-invalid @enderror" name="content" value="{{ $questions->content }}" autocomplete="content">

                            @error('content')
                            <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                수정하기
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
