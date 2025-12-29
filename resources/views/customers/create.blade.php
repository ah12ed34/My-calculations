@extends('layouts.app')
@section('back')
    <a href="{{ route('customers.index') }}" class="btn btn-secondary">رجوع</a>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create New Customer') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('customers.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" autocomplete="phone">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount_usd"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Dollar Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="amount_usd" type="number"
                                        class="form-control @error('amount_usd') is-invalid @enderror" name="amount_usd"
                                        value="{{ old('amount_usd') }}">

                                    @error('amount_usd')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount_yr"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Riyal Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="amount_yr" type="number"
                                        class="form-control @error('amount_yr') is-invalid @enderror" name="amount_yr"
                                        value="{{ old('amount_yr') }}">

                                    @error('amount_yr')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount_ys"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Saudi Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="amount_ys" type="number"
                                        class="form-control @error('amount_ys') is-invalid @enderror" name="amount_ys"
                                        value="{{ old('amount_ys') }}">

                                    @error('amount_ys')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount_egp"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Egyptian Pound Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="amount_egp" type="number"
                                        class="form-control @error('amount_egp') is-invalid @enderror" name="amount_egp"
                                        value="{{ old('amount_egp') }}">

                                    @error('amount_egp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount_try"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Turkish Lira Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="amount_try" type="number"
                                        class="form-control @error('amount_try') is-invalid @enderror" name="amount_try"
                                        value="{{ old('amount_try') }}">

                                    @error('amount_try')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
