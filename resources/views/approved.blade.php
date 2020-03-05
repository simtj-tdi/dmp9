@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">오류</div>

                    <div class="card-body">
                        관리자 승인 후 로그인 가능합니다.
                    </div>

                    <div class="card-footer">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                            @csrf

                            <button type="submit" class="btn btn-primary">
                                홈으로
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
