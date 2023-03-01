@extends('layouts.app')
@section('title','Task List')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Task List of <strong>{{ $to_do->name ?? '' }}</strong>
                <span class="float-end">
                    <a href="{{ route('add-tasks',encryptDecrypt($to_do->id,'encrypt')) }}" class="btn btn-sm btn-info">
                      <i class="bi bi-plus-circle"></i> Add Tasks
                    </a>
                    <a href="{{ route('to-do-list.index') }}" class="btn btn-primary btn-sm ">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </span>
            </div>
            <div class="card-body">
                @if(Session::has('message'))
                    <p class="alert alert-{{ Session::get('type') }} mt-1 alert-padding">{{ Session::get('message') }}</p>
                @endif
                @if(count($to_do->tasks))
                    <table class="table table-striped table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th width="5%">SN</th>
                            <th width="30%">Task Name</th>
                            <th width="50%">Description</th>
                            <th width="8%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($to_do->tasks as $key => $task)
                            <tr>
                              <th scope="row">{{ $key + 1 }}</th>
                              <td>{{ $task->task_name ?? '' }}</td>
                              <td>{{ $task->task_description ?? 'N/A' }}</td>
                              <td>
                                    <a href="{{ route('edit-task',encryptDecrypt($task->id,'encrypt')) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-item" data-id="delete-task-{{ $task->id }}">
                                      <form action="{{ route('delete-task',encryptDecrypt($task->id,'encrypt')) }}" method="POST" class="d-none" id="delete-task-{{ $task->id }}">
                                          @csrf
                                          @method('DELETE')
                                      </form>
                                      <i class="bi bi-trash"></i>
                                  </a>
                              </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                @else
                    <p class="alert alert-danger mt-2">No data found !</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection



@push('js')
    <script src="{{ asset('assets/js/task-list.js') }}"></script>
@endpush
