@extends('layouts.app')
@section('title','Home')
@section('page-title','Login')

@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            @if(Session::has('message'))
                <p class="alert alert-danger mt-1 alert-padding">{{ Session::get('message') }}</p>
            @endif
            <form action="{{ route('user-login') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <p class="alert alert-danger mt-1 alert-padding">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" >
                        @error('password')
                            <p class="alert alert-danger mt-1 alert-padding">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group text-center mt-2">
                        <button type="submit" class="custom-btn">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
@endpush
