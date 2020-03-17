@extends('dashboard')

@section('content')

                    <div class="card-header">Order Create</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf


                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">데이터명</label>

                                <div class="col-md-6">
                                    <input id="data_name" type="text" class="form-control  @error('data_name') is-invalid @enderror" name="data_name" value="" autocomplete="data_name">

                                    @error('data_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data_count" class="col-md-4 col-form-label text-md-right">데이터항목</label>

                                <div class="col-md-6">
{{--                                    <input id="data_category" type="text" class="form-control  @error('data_category') is-invalid @enderror" name="data_category" value="" autocomplete="data_category">--}}
                                    <select id="data_category" type="text" class="form-control @error('data_category') is-invalid @enderror" name="data_category" >
                                        <option value=""></option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                    </select>

                                    @error('data_category')
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


@endsection
