@extends('layouts.app')
@section('title','Edit -'.$to_do->name ?? '')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                Edit - {{ $to_do->name ?? '' }}
                <a href="{{ route('to-do-list.index') }}" class="btn btn-primary btn-sm float-end">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                @if(Session::has('message'))
                    <p class="alert alert-danger mt-1 alert-padding">{{ Session::get('message') }}</p>
                @endif
                <form method="POST" action="{{ route('to-do-list.update',encryptDecrypt($to_do->id,'encrypt')) }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                   <div class="form-group col-6">
                       <label for="">Name</label> <i class="bi bi-star-fill color-red"></i>
                       <input type="text" name="name" value="{{ $to_do->name ?? '' }}" class="form-control" placeholder="Name" required>
                       <div class="invalid-feedback">
                         The Name field is required
                      </div>
                   </div>

                    @if(sizeof($to_do->tasks) < 0))
                    <div class="form-group mt-2">
                        <label class="alert alert-info alert-padding">Pleas click on <b>Add Task</b> button to add new task</label>
                    </div>
                    @endif

                    <div class="form-group">
                        <table class="table table-bordered mt-2 {{ sizeof($to_do->tasks) < 0 ? 'd-none' : '' }}" id="task-table">
                            <thead>
                                <tr>
                                    <th>Task Name <i class="bi bi-star-fill color-red"></i></th>
                                    <th>Task Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($to_do->tasks as $task)
                                    <tr>
                                        <td style="width: 45%">
                                            <input type="hidden" name="task_id[]" value="{{ $task->id }}">
                                            <input type="text" name="task_name[]" value="{{ $task->task_name ?? '' }}" class="form-control" placeholder="Task Name" required>
                                        </td>
                                        <td style="width: 45%">
                                            <textarea name="task_description[]" class="form-control" rows="1"  placeholder="Task Description">{{ $task->task_description ?? '' }}</textarea>
                                        </td>
                                        <td style="width: 5%">
                                            <button type="button" class="btn btn-sm btn-danger text-right remove-task" >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        </td>
                                    </tr>
                                @endforeach
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
