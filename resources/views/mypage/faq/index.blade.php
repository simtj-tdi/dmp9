@extends('layouts.backend')

{{--{{$faqs}}--}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">FAQ</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($faqs as $faq)
                                <li class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <a href="{{ route('mypage.faq.show', $faq->id ) }}">
                                            <h5 class="mb-1">{{ $faq->id }}. {{ $faq->title }}</h5>
                                        </a>
                                        <small></small>
                                    </div>
                                    <p class="mb-1">{{ $faq->content }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn-primary" href="{{ route('mypage.faq.create') }}" role="button">글쓰기</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
