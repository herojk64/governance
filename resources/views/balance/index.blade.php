@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 my-4">
                <h1>Balance: {{auth()->user()->balance->balance ?? "0.0"}}</h1>
            </div>
            <div class="col-12 mb-4">
                <h2>Account Number: {{auth()->user()->account_number}}</h2>
            </div>
            <div>
                <p><a href="{{route('balance.create')}}">Recharge</a> your balance</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert fixed-bottom alert-success w-50">
            {{session('success')}}
        </div>
    @endif
@endsection
