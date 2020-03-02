@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">결제 취소</div>

                    <div class="card-body">

                        <div class="alert alert-danger" role="alert">
                            사용자의 의해서 취소 되었습니다.
                        </div>
                        <a class="btn btn-primary" href="javascript:self.close();" role="button">창 닫기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
