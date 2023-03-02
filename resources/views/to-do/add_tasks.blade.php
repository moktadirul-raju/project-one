@extends('layouts.app')
@section('title','Add tasks on - '.$to_do->name ?? '')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                Add new tasks on - <strong>{{ $to_do->name ?? '' }}</strong>
                <a href="{{ route('to-do-tasks',encryptDecrypt($to_do->id,'encrypt')) }}" class="btn btn-primary btn-sm float-end">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                @if(Session::has('message'))
                    <p class="alert alert-danger mt-1 alert-padding">{{ Session::get('message') }}</p>
                @endif
                <form method="POST" action="{{ route('add-tasks-on-to-do',encryptDecrypt($to_do->id,'encrypt')) }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group">
                        <table class="table table-bordered mt-2" id="task-table">
                            <thead>
                                <tr>
                                    <th>Task Name <i class="bi bi-star-fill color-red"></i></th>
                                    <th>Task Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-2">

                        <div class="form-group">
                            <button type="button" id="add-task" class="btn btn-info btn-sm">
                                <i class="bi bi-plus-circle-dotted"></i> Add Task
                            </button>
                        </div>
                    </div>

                    <div class="row mt-3 float-end mx-3">
                        <button type="submit" class="custom-btn">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/to-do-add-edit.js') }}"></script>
@endpush
