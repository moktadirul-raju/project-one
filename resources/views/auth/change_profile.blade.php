@extends('layouts.app')
@section('title','Update Profile')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Update Profile</div>
            <div class="card-body">
                @if(Session::has('message'))
                    <p class="alert alert-danger mt-1 alert-padding">{{ Session::get('message') }}</p>
                @endif
                <form method="POST" action="{{ route('update-profile') }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Name</label>
                        <div class="col-md-6">
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') ?? $user->name ?? '' }}"
                                   placeholder="Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') ?? $user->email }}"
                                placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Password</label>
                        <div class="col-md-6">
                            <input type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="custom-btn">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
