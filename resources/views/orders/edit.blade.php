@extends('dashboard')

@section('content')


    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Order Create</div>

            <div class="card-body">

                <form method="POST" action="{{ route('orders.update', $order->id) }}">
                    @csrf
                    @method('PUT')



                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label text-md-right">데이터명</label>

                        <div class="col-md-6">
                            <input id="data_name" type="text" class="form-control  @error('data_name') is-invalid @enderror" name="data_name" value="{{ $order->data_name }}" autocomplete="data_name">

                            @error('data_name')
                            <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="data_count" class="col-md-4 col-form-label text-md-right">데이터수</label>

                        <div class="col-md-6">
                            <input id="data_count" type="text" class="form-control  @error('data_count') is-invalid @enderror" name="data_count" value="{{ $order->data_count }}" autocomplete="data_count">

                            @error('data_count')
                            <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="buy_price" class="col-md-4 col-form-label text-md-right">구매가격</label>

                        <div class="col-md-6">
                            <input id="buy_price" type="text" class="form-control  @error('buy_price') is-invalid @enderror" name="buy_price" value="{{ $order->buy_price }}" autocomplete="buy_price">

                            @error('buy_price')
                            <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="buy_date" class="col-md-4 col-form-label text-md-right">구매일</label>

                        <div class="col-md-6">
                            <input id="buy_date" type="text" class="form-control  @error('buy_date') is-invalid @enderror" name="buy_date" value="{{ $order->buy_date }}" autocomplete="buy_date">

                            @error('buy_date')
                            <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="expiration_date" class="col-md-4 col-form-label text-md-right">유효기간</label>

                        <div class="col-md-6">
                            <input id="expiration_date" type="text" class="form-control  @error('expiration_date') is-invalid @enderror" name="expiration_date" value="{{ $order->expiration_date }}" autocomplete="expiration_date">

                            @error('expiration_date')
                            <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                저장하기
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
