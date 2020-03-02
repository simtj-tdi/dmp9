@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">결제 취소</div>

                    <div class="card-body">

                        <div class="alert alert-success" role="alert">
                            정상적으로 결제가 완료 되었습니다.
                        </div>
                        <a class="btn btn-primary" href="javascript:self.close();opener.location.reload(true);" role="button">창 닫기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
