@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome ') }} {{Auth::user()->nama}}
                    <br>
                    <a href="{{route('bayar.create')}}" class="btn btn-primary mt-3">Bayar</a>
                    <a href="{{ url('bayar/'.Auth::user()->username)}}" class="btn btn-success mt-3">Detail Pembayaran</a>
                    <a href="{{route('logout')}}" class="btn btn-danger mt-3">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection
