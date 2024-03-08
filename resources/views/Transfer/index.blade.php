@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <h1>
                    Balance: {{auth()->user()->balance->balance}}
                </h1>
            </div>
            <div class="col-12">
                <form class="" action="{{route('transfer.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="account_number" class="col-md-4 col-form-label text-md-end">{{ __('Account Number') }}</label>

                        <div class="col-md-6">
                            <input id="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number') }}" required  autofocus>

                            @error('account_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="amount" class="col-md-4 col-form-label text-md-end">{{ __('Amount') }}</label>

                        <div class="col-md-6">
                            <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required>

                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Transfer') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
