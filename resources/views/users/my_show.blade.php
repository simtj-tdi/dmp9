@extends('layouts.backend')

@section('content')


                <div class="card">
                    <div class="card-header"> Update </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('my_update') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">이름</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">비밀번호</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        수정
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="form-group row">
                            <label for="company_name" class="col-md-4 col-form-label text-md-right">상호</label>
                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="" required autocomplete="company_name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company_number" class="col-md-4 col-form-label text-md-right">등록번호</label>
                            <div class="col-md-6">
                                <input id="company_number" type="text" class="form-control @error('company_number') is-invalid @enderror" name="company_number" value="" required autocomplete="company_number" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="establishment" class="col-md-4 col-form-label text-md-right">사업장</label>
                            <div class="col-md-6">
                                <input id="establishment" type="text" class="form-control @error('establishment') is-invalid @enderror" name="establishment" value="" required autocomplete="establishment" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="establishment" class="col-md-4 col-form-label text-md-right">대표명</label>
                            <div class="col-md-6">
                                <input id="ceo" type="text" class="form-control @error('ceo') is-invalid @enderror" name="ceo" value="" required autocomplete="ceo" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="establishment" class="col-md-4 col-form-label text-md-right">업태</label>
                            <div class="col-md-6">
                                <input id="industry" type="text" class="form-control @error('industry') is-invalid @enderror" name="industry" value="" required autocomplete="industry" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="establishment" class="col-md-4 col-form-label text-md-right">종목</label>
                            <div class="col-md-6">
                                <input id="company_category" type="text" class="form-control @error('company_category') is-invalid @enderror" name="company_category" value="" required autocomplete="company_category" autofocus>
                            </div>
                        </div>

                    </div>



                </div>



@endsection
