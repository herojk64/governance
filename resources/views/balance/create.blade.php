@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Recharge your account') }}</div>

                <form action="{{route('balance.store')}}" method="POST" class="p-2">
            @csrf()
                    <div class="row mb-3">
                        <label for="balance" class="col-md-4 col-form-label text-md-end">{{ __('Balance') }}</label>

                        <div class="col-md-6">
                            <input id="balance" type="number" class="form-control @error('balance') is-invalid @enderror" name="balance" value="0" required autofocus>

                            @error('balance')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Recharge') }}
                                </button>
                            </div>
                        </div>
            </form>
        </div>
        </div>
    </div>

@endsection
