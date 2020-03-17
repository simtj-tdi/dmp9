@extends('dashboard')

@section('content')

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order Create</div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">데이터명</label>

                            <div class="col-md-6">
                                {{ $order->data_name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">데이터수</label>

                            <div class="col-md-6">
                                {{ $order->data_count }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">구매가격</label>

                            <div class="col-md-6">
                                {{ $order->buy_price }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">구매일</label>

                            <div class="col-md-6">
                                {{ $order->buy_date }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">유효기간</label>

                            <div class="col-md-6">
                                {{ $order->expiration_date }}
                            </div>
                        </div>



                        <a class="btn btn-primary" href="{{ route('orders.edit', $order->id) }}" role="button">수정하기</a>

                        <form method="POST" action="{{ route('orders.destroy', $order->id) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                삭제
                            </button>
                        </form>
                    </div>
                </div>
            </div>

@endsection
