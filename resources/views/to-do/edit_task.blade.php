@extends('layouts.app')
@section('title','Edit Task')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                Edit task
                <a href="{{ route('to-do-tasks',encryptDecrypt($task->to_do_list_id,'encrypt')) }}" class="btn btn-primary btn-sm float-end">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                @if(Session::has('message'))
                    <p class="alert alert-danger mt-1 alert-padding">{{ Session::get('message') }}</p>
                @endif
                <form method="POST" action="{{ route('update-task',encryptDecrypt($task->id,'encrypt')) }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                   <div class="form-group col-6">
                       <label for="">Task Name</label> <i class="bi bi-star-fill color-red"></i>
                       <input type="text" name="task_name" value="{{ $task->task_name ?? old('task_name') ?? '' }}" class="form-control" placeholder="Task Name" required>
                       <div class="invalid-feedback">
                         The Task Name field is required
                      </div>
                   </div>

                    <div class="form-group col-6 mt-2">
                       <label for="">Description</label>
                        <textarea name="task_description" class="form-control" rows="2" placeholder="Task Description">{{ $task->task_description ?? old('task_description') ?? '' }}</textarea>
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
@endpush
